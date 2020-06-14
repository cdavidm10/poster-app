<?php

class UserController extends Controller
{

    public function index(): void
    {
        header(DEFAULT_LOCATION);
    }
    public function register(): void
    {
        $this->view('user/register');
    }

    public function login(): void
    {
        $this->view('user/login');
    }

    public function create(): void
    {
        if (!$this->isPost()) {
            header(DEFAULT_LOCATION);
        }

        $data = $_POST;
        $loader = new LoaderData('users');
        $users = $loader->getData();
        $user = new User($data);

        if (empty($users) || empty($users[$user->getUsername()])) {
            $authenticator = new Authenticator();
            $users[$user->getUsername()] = [
                'email' => $user->getEmail(),
                'phone' => $user->getPhone(),
                'password' => $user->getPassword()
            ];
            $loader->saveData($users);
            $authenticator->login($user);
            echo json_encode([
                SUCCESS_KEY => 1,
                MESSAGE_KEY => 'User already created!'
            ]);
        } elseif (!empty($users[$user->getUsername()])) {
            echo json_encode([
                SUCCESS_KEY => 0,
                MESSAGE_KEY => 'User already exists!'
            ]);
        }
    }

    public function validate(): void
    {
        if (!$this->isPost()) {
            header(DEFAULT_LOCATION);
        }

        $data = $_POST;
        $loader = new LoaderData('users');
        $users = $loader->getData();
        $user = new User($data);

        if (!empty($users) && !empty($users[$user->getUsername()])) {
            $authenticator = new Authenticator();

            if (password_verify($data['password'], $user->getPassword())) {
                $authenticator->login($user);
                echo json_encode([
                    SUCCESS_KEY => 1,
                    MESSAGE_KEY => 'Log in was successfull!'
                ]);
            } else {
                echo json_encode([
                    SUCCESS_KEY => 0,
                    MESSAGE_KEY => 'Invalid Credentials!'
                ]);
            }
        } else {
            echo json_encode([
                SUCCESS_KEY => 0,
                MESSAGE_KEY => 'User doesn\'t exist!'
            ]);
        }
    }
}
