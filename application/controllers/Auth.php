<?php

Class Auth extends CI_Controller {
    
    function __construct() {
        parent ::__construct();
        $this->load->model('AuthData');
        
    }
    
    function index(){
        if(isset($_POST['Login']) && $_POST['Login'] !=''){
            $this->form_validation->set_rules('email','Email','trim|required|valid_email');
            $this->form_validation->set_rules('password','Password','trim|required');
            if($this->form_validation->run() == TRUE){
                if(count($this->AuthData->checkLogin($_POST['email'], $_POST['password'])) == 1) {
                    $sess_array = array('users_id' => $this->AuthData->checkLogin($_POST['email'], $_POST['password']));
                    $this->session->set_userdata('logged_in', $sess_array);
                    redirect(base_url() .'index.php/search','refresh');
                }
                else
                    echo 'login error';
            }
        }
        
        $data['pageContent'] = '      <div class="row">';
        $data['pageContent'] .= '        <div class="col-sm-2">';
        $data['pageContent'] .= '         <h4>Login</h4>';
        $data['pageContent'] .= '         <form action="'.base_url() . 'index.php/Auth" method="POST">';
        $data['pageContent'] .= '           <div class=form-group">';
        $data['pageContent'] .= '             <label>Email</label>';
        $data['pageContent'] .= '             <input type="text" name="email" class="form-control">';
        $data['pageContent'] .= '           </div>';
        $data['pageContent'] .= '           <div class=form-group">';
        $data['pageContent'] .= '             <label>Password</label>';
        $data['pageContent'] .= '             <input type="password" name="password" class="form-control">';
        $data['pageContent'] .= '           </div>';
        $data['pageContent'] .= '           <br />';
        $data['pageContent'] .= '           <div class=form-group">';
        $data['pageContent'] .= '             <input class="form-control btn-success" name="Login" value="Login" type="submit">';
        $data['pageContent'] .= '           </div>';
        $data['pageContent'] .= '         </form>';
        $data['pageContent'] .= '      </div>';
        $data['pageContent'] .= '    </div>';
        $this->load->view('SearchPage',$data);
    }
    
    function create(){
        if(isset($_POST['login']) && $_POST['login'] != ''){
            $this->form_validation->set_rules('email','Email','trim|required|valid_email');
            $this->form_validation->set_rules('password','Password','trim|required');
            $this->form_validation->set_rules('firstname','FirstName','trim|required');
            $this->form_validation->set_rules('lastname','LastName','trim|required');
            if($this->form_validation->run() == TRUE){
                $this->AuthData->createUser($_POST);
            }
        }
        
        
        
        $data['pageContent'] = '      <div class="row">';
        $data['pageContent'] .= '        <div class="col-sm-2">';
        $data['pageContent'] .= '         <h4>Create Account</h4>';
        $data['pageContent'] .= validation_errors();
        $data['pageContent'] .= '         <form action="'.base_url() . 'index.php/Auth/create" method="POST">';
        
        $data['pageContent'] .= '           <div class=form-group">';
        $data['pageContent'] .= '             <label>Email</label>';
        $data['pageContent'] .= '             <input type="text" name="email" class="form-control">';
        $data['pageContent'] .= '           </div>';
        
        $data['pageContent'] .= '           <div class=form-group">';
        $data['pageContent'] .= '             <label>Password</label>';
        $data['pageContent'] .= '             <input type="password" name="password" class="form-control">';
        $data['pageContent'] .= '           </div>';
        
        $data['pageContent'] .= '           <div class=form-group">';
        $data['pageContent'] .= '             <label>First Name</label>';
        $data['pageContent'] .= '             <input type="text" name="firstname" class="form-control">';
        $data['pageContent'] .= '           </div>';
        
        $data['pageContent'] .= '           <div class=form-group">';
        $data['pageContent'] .= '             <label>Last Name</label>';
        $data['pageContent'] .= '             <input type="text" name="lastname" class="form-control">';
        $data['pageContent'] .= '           </div>';
        
        $data['pageContent'] .= '           <br />';
        $data['pageContent'] .= '           <div class=form-group">';
        $data['pageContent'] .= '             <input class="form-control btn-success" name="login" value="Create Account" type="submit">';
        $data['pageContent'] .= '           </div>';
        $data['pageContent'] .= '         </form>';
        $data['pageContent'] .= '      </div>';
        $data['pageContent'] .= '    </div>';
        $this->load->view('SearchPage',$data);
    }
    
}

?>