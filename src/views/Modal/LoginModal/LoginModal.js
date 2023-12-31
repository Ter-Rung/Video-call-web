import React from 'react';
import { Modal, ModalBody } from 'reactstrap';
import './LoginModal.scss';
import $ from 'jquery';
import { compileString } from 'sass';
import { type } from '@testing-library/user-event/dist/type';

class LoginModal extends React.Component {
    state = {
        input: {},
        result: '',
    };

    handleChange = e => {
        const name = e.target.name;
        const value = e.target.value;
        this.setState({
            input: { ...this.state.input, [name]: value },
        });
    };

    handleSubmit = async e => {
        e.preventDefault();
        const form = $(e.target);
        await $.ajax({
            type: 'post',
            url: form.attr('action'),
            data: form.serialize(),
            success: data => {
                this.setState({
                    result: data,
                });
            },
        });
        const newResult = JSON.parse(this.state.result);

        if (newResult.success) {
            alert(newResult.message);
            sessionStorage.setItem('token', newResult.token);
            this.props.changePopUpLogin();
            this.props.changeIsLoginState();
            console.log(sessionStorage.getItem('token'));
        } else {
            alert(newResult.message);
        }
    };

    toggle = () => {
        this.props.changePopUpLogin();
    };

    render() {
        return (
            <Modal
                isOpen={this.props.popUpLogin}
                toggle={this.toggle}
                className={'ABCD'}
            >
                <ModalBody>
                    <div className="frame login-form">
                        <div className="login-form__header">
                            <h3 className="login-form_heading">Login</h3>
                        </div>

                        <div className="login-form__wrapper">
                            <div className="login-form__form">
                                <form
                                    action="http://localhost:8000/login.php"
                                    class="form-data"
                                    method="post"
                                    onSubmit={this.handleSubmit}
                                >
                                    <div className="login-form__group">
                                        <input
                                            type="text"
                                            name="username"
                                            className="login-form__input"
                                            placeholder="Username"
                                            onChange={this.handleChange}
                                        />
                                    </div>
                                    <div className="login-form__group">
                                        <input
                                            type="password"
                                            name="password"
                                            className="login-form__input"
                                            placeholder="Password"
                                            onChange={this.handleChange}
                                        />
                                    </div>

                                    <div className="login-form__group">
                                        <input
                                            type="submit"
                                            value="Login"
                                            name="submit"
                                            className="btn btn-login"
                                        />
                                    </div>
                                </form>
                            </div>

                            <div className="login-form__forgot-password">
                                <p className="login-form__text-forgot">
                                    I forgot my password.{' '}
                                    <a
                                        href="#"
                                        className="login-form__link-forgot"
                                    >
                                        Click here to reset
                                    </a>
                                </p>
                            </div>

                            <div className="login-form__register">
                                <a
                                    href="#"
                                    className="btn btn-register"
                                    onClick={() => {
                                        this.props.changePopUpLogin();
                                        this.props.changePopUpRegister();
                                    }}
                                >
                                    Register New Account
                                </a>
                            </div>
                        </div>
                    </div>
                </ModalBody>
            </Modal>
        );
    }
}

export default LoginModal;
