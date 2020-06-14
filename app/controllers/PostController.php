<?php

class PostController extends Controller
{
    private array $posts;
    private User $user;
    private LoaderData $loader_data;

    public function __construct()
    {
        $authenticator = new Authenticator();
        if (!$authenticator->isLogged()) {
            header(DEFAULT_LOCATION);
        } else {
            $this->user = $authenticator->getUser();
            $this->loader_data = new LoaderData('posts');
            $this->posts = $this->loader_data->getData();
        }
    }

    public function index(): void
    {
        $this->view('post/list', [
            'username' => $this->user->getUsername(),
            'email' => $this->user->getEmail(),
            'posts' => $this->posts
        ]);
    }

    public function create(): void
    {
        if (!$this->isPost()) {
            header(DEFAULT_LOCATION);
        }

        $data = $_POST;
        $data['username'] = $this->user->getUsername();
        $post = $this->model('Post', $data);
        $new_post = [
            'date' => $post->getMessage(),
            'message' => $post->getUsername(),
            'username' => $post->getDate()
        ];
        $this->posts[] = $new_post;

        $this->loader_data->saveData(array_reverse($this->posts));

        echo json_encode([
            SUCCESS_KEY => 1,
            MESSAGE_KEY => 'Message was successfully created!',
            'posts' => array_reverse($this->posts)
        ]);
    }
}
