import React, {Component} from 'react';
import ReactDOM from 'react-dom';

const RoomContainer = (props) => {
    return (<li>
        <a href="#" onClick={() => props.selectRoom(props.room.id)}>
            <div className="message-by">
                <div className="message-by-headline">
                    <h5>Chat room #{props.room.id}</h5>
                </div>
                <p>...</p>
            </div>
        </a>
    </li>);
};

const Message = (props) => {
    return (<div className={props.user === props.message.user_id ? "message-bubble me" : "message-bubble"}>
        <div className="message-bubble-inner">
            <div className="message-text"><p>{props.message.text}</p></div>
        </div>
        <div className="clearfix"></div>
    </div>);
};

const RoomContents = (props) => {
    return (
        <div className="message-content">

            <div className="messages-headline">
                <h4>Chat room #{props.roomId}</h4>
            </div>

            <div className="message-content-inner">
                {props.messages.map(message => <Message key={message.id} user={props.userId} message={message}/>)}
            </div>
            <div className="message-reply">
                <textarea cols="1" rows="1" placeholder="" name="messageText" data-autoresize
                          onChange={props.handleChange} value={props.messageText}></textarea>
                <button className="button ripple-effect" onClick={props.sendMessage}>Send</button>
            </div>
        </div>
    );
}

export default class Chat extends Component {
    constructor(props) {
        super(props);
        this.state = {
            rooms: [],
            activeRoom: null,
            messages: [],
            messageText: '',
            id: null,
        };

        this.selectRoom = this.selectRoom.bind(this);
        this.listenForBroadcast = this.listenForBroadcast.bind(this);
        this.sendMessage = this.sendMessage.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.revertMessage = this.revertMessage.bind(this);
    }

    handleChange(event) {
        this.setState({[event.target.name]: event.target.value});
    }

    selectRoom(id) {
        this.setState({
            activeRoom: id
        });

        this.listenForBroadcast(id);
    };

    revertMessage(message) {
        const newMessages = this.state.messages;

        this.setState({
            messages: newMessages.filter(mess => mess.id !== message.id)
        });
    }

    sendMessage() {
        const message = {
            text: this.state.messageText,
            user_id: this.state.id,
            id: Math.random().toString(36).substr(2, 9)
        };

        axios.post('chat', {
            room: this.state.activeRoom,
            message: this.state.messageText,
            user_id: this.state.id,
        }).catch(() => this.revertMessage(message));

        this.setState({
            messages: [...this.state.messages, message],
            messageText: ''
        });
    };

    render() {
        return (
            <div className="messages-container-inner">
                <div className="messages-inbox">
                    <ul>
                        {[...this.state.rooms].map(room => <RoomContainer key={room.id} selectRoom={this.selectRoom}
                                                                          room={room}/>)}
                    </ul>
                </div>
                {this.state.activeRoom ?
                    <RoomContents messages={this.state.messages} userId={this.state.id} sendMessage={this.sendMessage}
                                  handleChange={this.handleChange}
                                  messageText={this.state.messageText}
                                  roomId={this.state.activeRoom}/> : ''}
            </div>
        );
    }

    componentWillMount() {
        const rooms = JSON.parse(this.props.rooms);

        this.setState({
            rooms,
            id: this.props.id
        });
    }

    listenForBroadcast(id) {
        Echo.join('room.' + id).listen('ChatMessageSent', (e) => {
            this.setState({
                messages: [...this.state.messages, {
                    text: e.message,
                    user_id: e.user_id,
                    id: Math.random().toString(36).substr(2, 9)
                }]
            })
        });
    }
}

if (document.getElementById('chat')) {
    const component = document.getElementById('chat');
    const props = Object.assign({}, component.dataset);

    ReactDOM.render(<Chat {...props}/>, component);
}
