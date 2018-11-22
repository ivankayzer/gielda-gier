import React, {Component} from 'react';
import ReactDOM from 'react-dom';

const RoomContainer = (props) => {
    return (<li>
        <a href="#" onClick={() => props.selectRoom(props.room.id)}>
            <div className="message-by">
                <div className="message-by-headline">
                    <h5>Chat room #{ props.room.id }</h5>
                </div>
                <p>...</p>
            </div>
        </a>
    </li>);
};

const RoomContents = (props) => {
    return (
        <div className="message-content">

            <div className="messages-headline">
                <h4>Chat room #{ props.roomId }</h4>
            </div>

            <div className="message-content-inner">

                <div className="message-bubble me">
                    <div className="message-bubble-inner">
                        <div className="message-text"><p>Thanks for choosing my offer. I will start
                            working on your project tomorrow.</p></div>
                    </div>
                    <div className="clearfix"></div>
                </div>

                <div className="message-bubble">
                    <div className="message-bubble-inner">
                        <div className="message-text"><p>Great. If you need any further clarification
                            let me know. 👍</p></div>
                    </div>
                    <div className="clearfix"></div>
                </div>

                <div className="message-bubble me">
                    <div className="message-bubble-inner">
                        <div className="message-avatar"><img src="images/user-avatar-small-01.jpg"
                                                             alt=""/></div>
                        <div className="message-text"><p>Ok, I will. 😉</p></div>
                    </div>
                    <div className="clearfix"></div>
                </div>

                <div className="message-bubble me">
                    <div className="message-bubble-inner">
                        <div className="message-avatar"><img src="images/user-avatar-small-01.jpg"
                                                             alt=""/></div>
                        <div className="message-text"><p>Hi Sindy, I just wanted to let you know that
                            project is finished and I'm waiting for your approval.</p></div>
                    </div>
                    <div className="clearfix"></div>
                </div>

                <div className="message-bubble">
                    <div className="message-bubble-inner">
                        <div className="message-avatar"><img src="images/user-avatar-small-02.jpg"
                                                             alt=""/></div>
                        <div className="message-text"><p>Hi Tom! Hate to break it to you, but I'm
                            actually on vacation 🌴 until Sunday so I can't check it now. 😎</p>
                        </div>
                    </div>
                    <div className="clearfix"></div>
                </div>

                <div className="message-bubble me">
                    <div className="message-bubble-inner">
                        <div className="message-avatar"><img src="images/user-avatar-small-01.jpg"
                                                             alt=""/></div>
                        <div className="message-text"><p>Ok, no problem. But don't forget about last
                            payment. 🙂</p></div>
                    </div>
                    <div className="clearfix"></div>
                </div>

                <div className="message-bubble">
                    <div className="message-bubble-inner">
                        <div className="message-avatar"><img src="images/user-avatar-small-02.jpg"
                                                             alt=""/></div>
                        <div className="message-text">
                            <div className="typing-indicator">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                    <div className="clearfix"></div>
                </div>
            </div>
            <div className="message-reply">
                <textarea cols="1" rows="1" placeholder="Your Message" data-autoresize></textarea>
                <button className="button ripple-effect" onClick={() => props.sendMessage('text')}>Send</button>
            </div>
        </div>
    );
}

export default class Chat extends Component {
    constructor(props) {
        super(props);
        this.state = {
            rooms: [],
            activeRoom: null
        };

        this.selectRoom = this.selectRoom.bind(this);
        this.listenForBroadcast = this.listenForBroadcast.bind(this);
        this.sendMessage = this.sendMessage.bind(this);
    }

    selectRoom(id) {
        this.setState({
            activeRoom: id
        });

        this.listenForBroadcast(id);
    };

    sendMessage(text) {
        axios.post('chat', {
            room: this.state.activeRoom,
            message: text
        }).then(function(response) {
            console.log(response);
        });
    };

    render() {
        return (
            <div className="messages-container-inner">
                <div className="messages-inbox">
                    <ul>
                        { [...this.state.rooms].map(room => <RoomContainer selectRoom={this.selectRoom} room={room} />) }
                    </ul>
                </div>
                { this.state.activeRoom ? <RoomContents sendMessage={this.sendMessage} roomId={this.state.activeRoom}/> : '' }
            </div>
        );
    }

    componentWillMount() {
        const rooms = JSON.parse(this.props.rooms);

        this.setState({
            rooms
        });
    }

    listenForBroadcast(id) {
        console.log('listening for broadcast ' + 'room.' + id);

        Echo.private('room.' + id).listen('ChatMessageSent', (e) => { console.log(123) });
    }
}

if (document.getElementById('chat')) {
    const component = document.getElementById('chat');
    const props = Object.assign({}, component.dataset);

    ReactDOM.render(<Chat {...props}/>, component);
}
