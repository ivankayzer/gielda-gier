import React, {Component} from 'react';
import ReactDOM from 'react-dom';

export default class Chat extends Component {
    constructor(props) {
        super(props);
        this.state = {
            rooms: []
        };
    }

    render() {
        return (
            <div className="messages-container-inner">
                <div className="messages-inbox">
                    <ul>
                        <li>
                            <a href="#">
                                <div className="message-avatar">
                                    <img src="images/user-avatar-small-03.jpg" alt=""/>
                                </div>

                                <div className="message-by">
                                    <div className="message-by-headline">
                                        <h5>David Peterson</h5>
                                        <span>4 hours ago</span>
                                    </div>
                                    <p>Thanks for reaching out. I'm quite busy right now on many</p>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div className="message-content">

                    <div className="messages-headline">
                        <h4>Sindy Forest</h4>
                    </div>

                    <div className="message-content-inner">

                        <div className="message-time-sign">
                            <span>28 June, 2018</span>
                        </div>

                        <div className="message-bubble me">
                            <div className="message-bubble-inner">
                                <div className="message-avatar"><img src="images/user-avatar-small-01.jpg"
                                                                     alt=""/></div>
                                <div className="message-text"><p>Thanks for choosing my offer. I will start
                                    working on your project tomorrow.</p></div>
                            </div>
                            <div className="clearfix"></div>
                        </div>

                        <div className="message-bubble">
                            <div className="message-bubble-inner">
                                <div className="message-avatar"><img src="images/user-avatar-small-02.jpg"
                                                                     alt=""/></div>
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

                        <div className="message-time-sign">
                            <span>Yesterday</span>
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
                        <button className="button ripple-effect">Send</button>
                    </div>
                </div>
            </div>
        );
    }

    componentWillMount() {
        const rooms = JSON.parse(this.props.rooms);

        this.setState({
            rooms
        });
    }
}

if (document.getElementById('chat')) {
    const component = document.getElementById('chat');
    const props = Object.assign({}, component.dataset);

    ReactDOM.render(<Chat {...props}/>, component);
}
