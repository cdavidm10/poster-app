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
        }
    }

    public function index(): void
    {
        $this->posts = $this->loader_data->getData();
        $this->view('post/list', [
            'username' => $this->user->getUsername(),
            'posts' => $_SESSION['posts'] ?? $this->posts,
            'filtered' => $_SESSION['filtered'] ?? false,
            'filter' => $_SESSION['filter'] ?? ''
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
            'message' => $post->getMessage(),
            'username' => $post->getUsername(),
            'date' => $post->getDate()
        ];
        $this->posts = $this->loader_data->getData();
        $this->posts[] = $new_post;

        $this->loader_data->saveData(array_reverse($this->posts));

        echo json_encode([
            SUCCESS_KEY => 1,
            MESSAGE_KEY => 'Message was successfully created!'
        ]);
    }

    public function filter(): void
    {
        if (!$this->isPost()) {
            header(DEFAULT_LOCATION);
        }

        $filter = trim($_POST['filter']);
        $daterange = trim($_POST['daterange']);

        $filter_dates = explode(' - ', trim($daterange));

        $posts_filtered = [];
        $this->posts = $this->loader_data->getData();

        foreach ($this->posts as $data_post) {
            $post = $this->model('Post', $data_post);
            if ($post->canBeFiltered($filter,  $filter_dates)) {
                $posts_filtered[] = $data_post;
            }
        }

        $this->loader_data->saveDataOnSesion($posts_filtered,  $filter, $daterange);

        echo json_encode([
            SUCCESS_KEY => 1,
            MESSAGE_KEY => 'Posts were successfully filtered!'
        ]);
    }

    public function clearFilter(): void
    {
        if (!$this->isPost()) {
            header(DEFAULT_LOCATION);
        }

        $this->loader_data->removeDataOnSesion();

        echo json_encode([
            SUCCESS_KEY => 1,
            MESSAGE_KEY => 'Filter was successfully cleared!'
        ]);
    }
}
