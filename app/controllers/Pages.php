<?php
class Pages extends Controller {
    public function __construct() {
        // load Models into the cunstructor        
    }
    
    public function index() {
        $data = [
            // pass the model into data array as variable
            'title' => 'Welcome',
        ];
        
        $this->view('pages/index', $data);
    }

    public function about() {
        $this->view('pages/about');
    }
}