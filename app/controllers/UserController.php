<?php

class UserController extends Controller
{

    public function index(): void
    {
        header("Location: /");
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
            header("Location: /");
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
                'success' => 1,
                'message' => 'User already created!'
            ]);
        } elseif (!empty($users[$user->getUsername()])) {
            echo json_encode([
                'success' => 0,
                'message' => 'User already exists!'
            ]);
        }
    }

    public function load(): void
    {
        // Ver el ejemplo de password_hash() para ver de dónde viene este hash.
        $hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';

        if (password_verify('rasmuslerdorf', $hash)) {
            echo '¡La contraseña es válida!';
        } else {
            echo 'La contraseña no es válida.';
        }
    }
}
