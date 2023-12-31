import React from 'react';
import './Nav.scss';
import logo from '../../assets/images/logo.png';
import { withRouter } from 'react-router';
import LoginModal from '../Modal/LoginModal/LoginModal';
import { Link, NavLink } from 'react-router-dom';
class Nav extends React.Component {
    handleClickLogin = () => {
        this.props.changePopUpLogin();
    };

    render() {
        let isLogin = this.props.isLogin;
        return (
            <>
                <header>
                    <div className="header-container">
                        <img
                            className="logo"
                            src={logo}
                            alt="logo"
                            onClick={() => {
                                this.props.history.push('/');
                            }}
                        />
                        <div className="nav">
                            <a className="video-chat" href="#">
                                Video chat
                            </a>

                            <a className="about-us" href="#">
                                About us
                            </a>
                        </div>
                        {isLogin ? (
                            <div className="avata">
                                <img
                                    src={require('../../assets/images/avt.jpeg')}
                                    alt="avata"
                                />
                                <button
                                    onClick={() => {
                                        sessionStorage.removeItem('token');
                                        window.location.reload();
                                    }}
                                >
                                    Logout
                                </button>
                            </div>
                        ) : (
                            <button
                                className="btn btn-Login"
                                onClick={this.handleClickLogin}
                            >
                                <a
                                    href="#"
                                    className="header__navbar-icon-link"
                                >
                                    <i className="fa-solid fa-mobile-screen"></i>
                                </a>
                                <a
                                    href="#"
                                    className="header__navbar-icon-link"
                                >
                                    <i className="fab fa-facebook"></i>
                                </a>
                                <a
                                    href="#"
                                    className="header__navbar-icon-link"
                                >
                                    <i className="fa-brands fa-google"></i>
                                </a>
                                <a
                                    href="#"
                                    className="header__navbar-icon-link"
                                >
                                    <i className="fa-brands fa-apple"></i>
                                </a>
                                <a
                                    href="#"
                                    className="header__navbar-item-link"
                                >
                                    Login
                                </a>
                            </button>
                        )}
                    </div>
                </header>
            </>
        );
    }
}

export default withRouter(Nav);
