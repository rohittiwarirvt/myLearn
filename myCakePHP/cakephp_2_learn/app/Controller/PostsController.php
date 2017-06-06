<?php

class PostsController extends AppController{
  public $helpers = array('Html', 'Form','Flash');
  public $components = array('Flash');

  public function index() {
    $this->set('posts', $this->Post->find('all'));
  }

  public function view($id = null) {
    if (!$id) {
      throw new NotfoundException(__('Invalid post'));
    }
    $post = $this->Post->findById($id);
    if (!$post) {
      throw new NotfoundException(__('Invalid post'));
    }
    $this->set('post', $post);
  }

  public function add() {
    if ($this->request->is('post')) {
      $this->Post->create();
      if ($this->Post->save($this->request->data)) {
       $this->Flash->success(__('Your post has been saved.'));
       return $this->redirect(array('action'=> 'index'));
      }
      $this->Flash->error(__('Unable to add your post.'));
    }
  }

  public function edit($id = null) {
    if(!$id) {
      throw new NotfoundException(__('Invalid post'));
    }
    $post = $this->Post->findById($id);
    if (!$post) {
      throw new NotfoundException(__('Invalid post'));
    }

    if ($this->request->is(array('post','put'))) {
      $this->Post->id = $id;
      if ($this->Post->save($this->request->data)) {
        $this->Flash->success(__('Your Post has been Updated'));
        $this->redirect(array('action' => 'index'));
      }
      $this->Flash->error(__('Unable to update the post.'));
    }

    if (!$this->request->data) {
      $this->request->data = $post;
    }
  }

  public function delete($id= null) {
    if($this->request->is('get')) {
      throw new MethodNotAllowedException();
    }
    if (!$id) {
      throw new NotfoundException(__('Post not found.'));
    }
    if ($this->request->is('post')) {
      if ($this->Post->delete($id)){
        $this->Flash->success(
            __('The post with id: %s could not be deleted.', h($id))
          );
      }else {
        $this->Flash->error(
          __('The post with id: %s could not be deleted', h($id))
          );
      }
    }
    $this->redirect(array('action' =>'index'));
  }
}
