import React, {Component} from 'react';
import ReactDOM from 'react-dom';

const RoomContainer = (props) => {
    return (<li>
        <a href="#" onClick={() => props.selectRoom(props.room.id)}>
            <div className="message-by">
                <div className="message-avatar">
                    <img src={props.room.otherUser.avatar} alt={props.room.otherUser.name}/>
                </div>
                <div className="message-by-headline">
                    <h5>Chat z {props.room.otherUser.name}</h5>
                    <span>4 hours ago</span>
                </div>
                <p>{ props.room.messages.slice(-1)[0].message }</p>
            </div>
        </a>
    </li>);
};

const Message = (props) => {
    return (<div
        className={parseInt(props.user) === parseInt(props.message.sender_id) ? "message-bubble me" : "message-bubble"}>
        <div className="message-bubble-inner" id="scrollContainer">
            <div className="message-avatar"><img src={
                parseInt(props.user) === parseInt(props.message.sender_id)
                    ? props.room.currentUser.avatar
                    : props.room.otherUser.avatar
            }
                                                 alt=""/></div>
            <div className="message-text"><p>{props.message.message}</p></div>
        </div>
        <div className="clearfix"></div>
    </div>);
};

class RoomContents extends Component {
    constructor(props) {
        super(props)
    }

    componentDidMount () {
        this.props.scroll();
    }

    render () {
        return (
            <div className="message-content">

                <div className="messages-headline">
                    <h4>Chat z {this.props.room.otherUser.name}</h4>
                </div>

                <div className="message-content-inner" ref={(el) => { this.messagesContainer = el; }}>
                    {this.props.messages.map(message => <Message key={message.id} room={this.props.room} user={this.props.userId}
                                                            message={message}/>)}

                </div>
                <div className="message-reply">
                <textarea cols="1" rows="1" placeholder="" name="messageText" data-autoresize
                          onChange={this.props.handleChange} value={this.props.messageText}></textarea>
                    <button className="button ripple-effect" onClick={this.props.sendMessage}>Send</button>
                </div>
            </div>
        );
    }
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
            activeRoomObject: null
        };

        this.selectRoom = this.selectRoom.bind(this);
        this.listenForBroadcast = this.listenForBroadcast.bind(this);
        this.sendMessage = this.sendMessage.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.revertMessage = this.revertMessage.bind(this);
        this.scroll = this.scroll.bind(this);
    }

    scroll() {
        setTimeout(() => document.querySelector('.message-content-inner .message-bubble:last-child').scrollIntoView({behavior: 'smooth'}), 250);
    }

    handleChange(event) {
        this.setState({[event.target.name]: event.target.value});
    }

    selectRoom(id) {
        this.setState({
            activeRoom: id,
            activeRoomObject: this.state.rooms.filter(room => room.id === id)[0]
        }, () => this.scroll());

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
            message: this.state.messageText,
            sender_id: this.state.id,
            id: Math.random().toString(36).substr(2, 9)
        };

        axios.post('chat', {
            room: this.state.activeRoom,
            message: this.state.messageText,
            user_id: this.state.id,
        }).catch(() => this.revertMessage(message));

        const rooms = this.state.rooms.map(room => {
            if (room.id === this.state.activeRoom) {
                room.messages = [...this.state.activeRoomObject.messages, message];
            }

            return room;
        });

        this.setState({
            rooms,
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
                    <RoomContents messages={this.state.activeRoomObject.messages} userId={this.state.id}
                                  sendMessage={this.sendMessage}
                                  handleChange={this.handleChange}
                                  scroll={this.scroll}
                                  messageText={this.state.messageText}
                                  roomId={this.state.activeRoom} room={this.state.activeRoomObject}/> : ''}
            </div>
        );
    }

    componentWillMount() {
        const rooms = JSON.parse(this.props.rooms);

        this.setState({
            rooms,
            id: this.props.id,
            activeRoomObject: this.state.rooms[0]
        }, () => this.selectRoom(this.state.rooms[0].id));
    }

    listenForBroadcast(id) {
        Echo.join('room.' + id).listen('ChatMessageSent', (e) => {
            const rooms = this.state.rooms.map(room => {
                if (room.id === id) {
                    room.messages = [...this.state.activeRoomObject.messages, {
                        message: e.message,
                        sender_id: e.user_id,
                        id: Math.random().toString(36).substr(2, 9)
                    }];
                }

                return room;
            });

            this.setState({
                rooms
            })
        });
    }
}

if (document.getElementById('chat')) {
    const component = document.getElementById('chat');
    const props = Object.assign({}, component.dataset);

    ReactDOM.render(<Chat {...props}/>, component);
}
