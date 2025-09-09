<!-----author--ghafooryabdullah@gmail.com
https://www.figma.com/community/file/1509907007668061144
my telegram channel : @Foxcod_ir
-->
<link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
    rel="stylesheet">

<style>
    /* Reset Css */
    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        border: none;
        font: inherit;
        vertical-align: baseline;
        line-height: 1;
        font-family: "inter";
        text-decoration: none;
    }

    button,
    input {
        font: inherit;
        border: none;
    }

    /* Variables */
    :root {
        --primary-color: #1f42ccdf;
        --text-color: #DADADA;
        --background-body: linear-gradient(to top, #0d0d0d, rgb(20, 20, 20, 0.9));
        --form-background: linear-gradient(to top, #0d0d0d, rgba(255, 255, 255, 0.1));
    }

    /* App Css */
    a:hover,
    button:hover {
        opacity: 0.8;
    }

    a {
        color: inherit;
    }

    body {
        user-select: none;
        flex-direction: column;
        min-height: 100vh;
        color: var(--text-color);
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--background-body);
    }

    .form__section {
        width: 100%;
    }

    .form {
        max-width: 300px;
        width: 100%;
        background: var(--form-background);
        border-radius: 8px;
        border: 2px solid #414141;
        padding: 30px;
        margin: 0 auto;
    }

    .form__title {
        font-weight: 600;
        font-size: 20px;
    }

    .form__sub-title {
        margin-top: 8px;
        font-size: 12px;
    }

    .form__input-label {
        display: block;
        font-weight: 600;
        font-size: 12px;
        margin-top: 32px;
    }

    .form__input-wrapper {
        margin-top: 4px;
        position: relative;
        height: 36px;
    }

    .form__input {
        background-color: #303030;
        border: 1px solid #414141;
        border-radius: 4px;
        padding: 0px 16px;
        height: 36px;
        font-size: 12px;
        width: 100%;
        outline: none;
        color: inherit;
    }

    .form__input:focus {
        border-color: var(--primary-color);
    }

    .form__input::placeholder {
        color: inherit;
    }

    .form__input--has-svg {
        padding-right: 40px;
    }

    .form__pass-toggle {
        width: 20px;
        height: 20px;
        position: absolute;
        top: 0;
        bottom: 0;
        margin: auto 0;
        right: 16px;
        transition: all 100ms linear;
    }

    .form__pass-toggle--active {
        transform: rotate(90deg);
        color: var(--primary-color);
    }

    .form__remmember {
        display: block;
        font-size: 12px;
        margin-top: 32px;
    }

    .form__submit-btn {
        margin-top: 32px;
        width: 100%;
        height: 39px;
        border-radius: 4px;
        background-color: var(--primary-color);
        font-size: 16px;
        font-weight: 600;
        color: #fefefb;
        cursor: pointer;
    }

    .form__sign-up {
        margin-top: 32px;
        display: block;
        font-size: 12px;

    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Admin Login </title>
</head>

<body>
    <section class="form__section">
        <form class="form" action="{{ route('login') }}" method="POST">

            @csrf

            <div class="form__title"> Login Form </div>
            <div class="form__sub-title">Please Sign In to Access Your Account</div>
            <label class="form__input-label"> Username </label>
            <div class="form__input-wrapper">
                <input class="form__input" id="username" name="email" placeholder="Type your username or email..." type="text" required>
            </div>
            <label class="form__input-label">Password</label>
            <div class="form__input-wrapper">
                <input id="password-input" name="password" class="form__input form__input--has-svg" placeholder="Type your password..."
                    type="password" required>
                <div class="form__pass-toggle">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_216_38)">
                            <path
                                d="M0.833374 9.99998C0.833374 9.99998 4.16671 3.33331 10 3.33331C15.8334 3.33331 19.1667 9.99998 19.1667 9.99998C19.1667 9.99998 15.8334 16.6666 10 16.6666C4.16671 16.6666 0.833374 9.99998 0.833374 9.99998Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M10 12.5C11.3807 12.5 12.5 11.3807 12.5 10C12.5 8.61929 11.3807 7.5 10 7.5C8.61929 7.5 7.5 8.61929 7.5 10C7.5 11.3807 8.61929 12.5 10 12.5Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </g>
                        <defs>
                            <clipPath id="clip0_216_38">
                                <rect width="20" height="20" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                </div>
            </div>
            <a href="#" class="form__remmember">Forgot your password?</a>
            <button class="form__submit-btn"> Login </button>
            <a href="#" class="form__sign-up">Create a New Account</a>
        </form>
    </section>
</body>

</html>
