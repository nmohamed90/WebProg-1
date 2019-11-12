<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('SearchData');
    }
    
    function index() {
        if($this->session->userdata('logged_in')) {
        $sessionData = $this->session->userdata('logged_in');
        $data['userID'] = $sessionData['users_id'];
        
        $data['pageTitle'] = 'Zach Cagle Site';
        
        $data['pageContent'] = '';
        
        //foreach($this->SearchData->getStates() as $rows){
        //    echo $rows->state . '<br />';
        //}
        //echo '<pre />';
        //print_r(openssl_get_cipher_methods());
        
        echo $var1 = openssl_encrypt('Zach', 'AES-256-ECB', PASSWORD.$sessionData['users_id']);
        echo openssl_decrypt($var1, 'AES-256-ECB', PASSWORD.$sessionData['users_id']);
        
        $data['pageContent'] .= '      <div class="row">';
$data['pageContent'] .= '        <div class="col-sm-2">';
$data['pageContent'] .= '         <h4>Welcome User '. $sessionData['users_id'] .'</h4>';
$data['pageContent'] .= '         <form action="'.base_url() . 'index.php/Search" method="get">';

$data['pageContent'] .= '           <div class=form-group">';
$data['pageContent'] .= '             <label>State</label>';

$data['pageContent'] .= '             <select name ="state" class="form-control">';
$data['pageContent'] .= '               <option value = ""></option>';

foreach($this->SearchData->getStates() as $rows){
    $data['pageContent'] .= '               <option value = "' . urlencode(openssl_encrypt($rows->state, 'AES-256-ECB', PASSWORD.$sessionData['users_id']))  . '" ' . (isset($_GET['state']) && openssl_decrypt(urldecode($_GET['state']),'AES-256-ECB',PASSWORD.$sessionData['users_id']) == $rows->state ? 'selected' : '') . '>' . $rows->statefull . '</option>';

}
$data['pageContent'] .= '             </select>';
$data['pageContent'] .= '           </div>';

$data['pageContent'] .= '           <div class=form-group">';
$data['pageContent'] .= '             <label>Gender</label>';
$data['pageContent'] .= '             <select name ="gender" class="form-control">';
$data['pageContent'] .= '               <option value=""></option>';
$data['pageContent'] .= '               <option value="'.urlencode(openssl_encrypt('female', 'AES-256-ECB', PASSWORD.$sessionData['users_id'])) .'"'. (isset($_GET['gender']) && openssl_decrypt(urldecode($_GET['gender']),'AES-256-ECB',PASSWORD.$sessionData['users_id']) == 'female' ? 'selected' : '') . '>Female</option>';
$data['pageContent'] .= '               <option value="'.urlencode(openssl_encrypt('male', 'AES-256-ECB', PASSWORD.$sessionData['users_id'])) .'"'. (isset($_GET['gender']) && openssl_decrypt(urldecode($_GET['gender']),'AES-256-ECB',PASSWORD.$sessionData['users_id']) == 'male' ? 'selected' : '') . '>Male</option>';
$data['pageContent'] .= '             </select>';
$data['pageContent'] .= '           </div>';
$data['pageContent'] .= '           <br />';
$data['pageContent'] .= '           <div class=form-group">';
$data['pageContent'] .= '             <input class="form-control btn-success" name="search" type="submit">';
$data['pageContent'] .= '           </div>';
$data['pageContent'] .= '         </form>';
$data['pageContent'] .= '      </div>';
$data['pageContent'] .= '      <div class="col-sm-7">';
   
if(isset($_POST['update']) && $_POST['update']!=''){
            
        $this->SearchData->updateUsersRecord(openssl_decrypt($_GET['id'],'AES-256-ECB',PASSWORD.$sessionData['users_id']));
}

if (isset($_GET['state']) && $_GET['state'] != '' && isset($_GET['gender']) && $_GET['gender'] != '') {
  $data['pageContent'] .= '       <h4>Results</h4>';
  $data['pageContent'] .= '       <table class="table">';
  $data['pageContent'] .= '         <thead>';
  $data['pageContent'] .= '           <tr>';
  $data['pageContent'] .= '             <th scope="col">ID</th>';
  $data['pageContent'] .= '             <th scope="col">Last Name</th>';
  $data['pageContent'] .= '             <th scope="col">First Name</th>';
  $data['pageContent'] .= '             <th scope="col">Address</th>';
  $data['pageContent'] .= '             <th scope="col">City</th>';
  $data['pageContent'] .= '             <th scope="col">State</th>';
  $data['pageContent'] .= '             <th scope="col">Zip</th>';
  $data['pageContent'] .= '             <th scope="col">Phone</th>';
  $data['pageContent'] .= '             <th scope="col">Gender</th>';
  $data['pageContent'] .= '             <th scope="col">Age</th>';
  $data['pageContent'] .= '           </tr>';
  $data['pageContent'] .= '         </thead>';
  $data['pageContent'] .= '         <tbody>';

  foreach($this->SearchData->getUsers(openssl_decrypt(urldecode($_GET['state']),'AES-256-ECB',PASSWORD.$sessionData['users_id']), openssl_decrypt(urldecode($_GET['gender']),'AES-256-ECB',PASSWORD.$sessionData['users_id'])) as $row){
      $data['pageContent'] .= '           <tr>';
      $data['pageContent'] .= '             <td scope="col"><a href="'.base_url(). 'index.php/Search?state=' . urlencode($_GET['state']) . '&gender=' . urlencode($_GET['gender']) . '&id=' . urlencode(openssl_encrypt($row->number,'AES-256-ECB',PASSWORD.$sessionData['users_id'])) . '">' . $row->number . '</a></td>';
      $data['pageContent'] .= '             <td scope="col">' . $row->surname . '</td>';
      $data['pageContent'] .= '             <td scope="col">' . $row->givenname . '</td>';

      $data['pageContent'] .= '             <td scope="col">' . $row->streetaddress . '</td>';
      $data['pageContent'] .= '             <td scope="col">' . $row->city . '</td>';
      $data['pageContent'] .= '             <td scope="col">' . $row->state . '</td>';
      $data['pageContent'] .= '             <td scope="col">' . $row->zipcode . '</td>';
      $data['pageContent'] .= '             <td scope="col">' . $row->telephonenumber . '</td>';
      $data['pageContent'] .= '             <td scope="col">' . $row->gender . '</td>';
      $data['pageContent'] .= '             <td scope="col">' . $row->age . '</td>';
      $data['pageContent'] .= '           </tr>';
    }
  
  $data['pageContent'] .= '         </tbody>';
  $data['pageContent'] .= '       </table>';
}
$data['pageContent'] .= '        </div>';
$data['pageContent'] .= '        <div class="col-sm-3">';

if (isset($_GET['id']) && $_GET['id'] != '') {




  if (isset($message))
    $data['pageContent'] .= $message;
  
  
    $data['pageContent'] .= '         <h4>Details</h4>';
    $data['pageContent'] .= '         <form action="'.base_url(). 'index.php/Search?state=' . urlencode($_GET['state']) . '&gender=' . urlencode($_GET['gender']) . '&id=' . urlencode($_GET['id']) . '" method="POST">';
    $data['pageContent'] .= '         <table class="table">';
    $data['pageContent'] .= '           <tbody>';
    $data['pageContent'] .= '             <tr>';
    $data['pageContent'] .= '               <td>Last Name</td>';
    $data['pageContent'] .= '               <td><input type="text" name="update_lastname" value="' . $this->SearchData->getUsersLastName(openssl_decrypt($_GET['id'],'AES-256-ECB',PASSWORD.$sessionData['users_id']))[0]->surname . '" class="form-control"></td>';
    $data['pageContent'] .= '             </tr>';
    $data['pageContent'] .= '             <tr>';
    $data['pageContent'] .= '               <td>First Name</td>';
    $data['pageContent'] .= '               <td><input type="text" name="update_firstname" value="' . $this->SearchData->getUsersFirstName(openssl_decrypt($_GET['id'],'AES-256-ECB',PASSWORD.$sessionData['users_id']))[0]->givenname . '" class="form-control"></td>';
    $data['pageContent'] .= '             </tr>';
    $data['pageContent'] .= '             <tr>';
    $data['pageContent'] .= '               <td>Address</td>';
    $data['pageContent'] .= '               <td><input type="text" name="update_address" value="' . $this->SearchData->getUsersAddress(openssl_decrypt($_GET['id'],'AES-256-ECB',PASSWORD.$sessionData['users_id']))[0]->streetaddress . '" class="form-control"></td>';
    $data['pageContent'] .= '             </tr>';
    $data['pageContent'] .= '             <tr>';
    $data['pageContent'] .= '               <td>City</td>';
    $data['pageContent'] .= '               <td><input type="text" name="update_city" value="' . $this->SearchData->getUsersCity(openssl_decrypt($_GET['id'],'AES-256-ECB',PASSWORD.$sessionData['users_id']))[0]->city . '" class="form-control"></td>';
    $data['pageContent'] .= '             </tr>';
    $data['pageContent'] .= '             <tr>';
    $data['pageContent'] .= '               <td>State</td>';
    $data['pageContent'] .= '               <td><input type="text" name="update_state" value="' . $this->SearchData->getUsersState(openssl_decrypt($_GET['id'],'AES-256-ECB',PASSWORD.$sessionData['users_id']))[0]->state . '" class="form-control"></td>';
    $data['pageContent'] .= '             </tr>';
    $data['pageContent'] .= '             <tr>';
    $data['pageContent'] .= '               <td>Zip</td>';
    $data['pageContent'] .= '               <td><input type="text" name="update_zip" value="' . $this->SearchData->getUsersZip(openssl_decrypt($_GET['id'],'AES-256-ECB',PASSWORD.$sessionData['users_id']))[0]->zipcode . '" class="form-control"></td>';
    $data['pageContent'] .= '             </tr>';
    $data['pageContent'] .= '             <tr>';
    $data['pageContent'] .= '               <td>Phone</td>';
    $data['pageContent'] .= '               <td><input type="text" name="update_phone" value="' . $this->SearchData->getUsersPhone(openssl_decrypt($_GET['id'],'AES-256-ECB',PASSWORD.$sessionData['users_id']))[0]->telephonenumber . '" class="form-control"></td>';
    $data['pageContent'] .= '             </tr>';
    $data['pageContent'] .= '             <tr>';
    $data['pageContent'] .= '               <td>Gender</td>';
    $data['pageContent'] .= '               <td><input type="text" name="update_gender" value="' . $this->SearchData->getUsersGender(openssl_decrypt($_GET['id'],'AES-256-ECB',PASSWORD.$sessionData['users_id']))[0]->gender . '" class="form-control"></td>';
    $data['pageContent'] .= '             </tr>';
    $data['pageContent'] .= '             <tr>';
    $data['pageContent'] .= '               <td>Age</td>';
    $data['pageContent'] .= '               <td><input type="text" name="update_age" value="' . $this->SearchData->getUsersAge(openssl_decrypt($_GET['id'],'AES-256-ECB',PASSWORD.$sessionData['users_id']))[0]->age . '" class="form-control"></td>';
    $data['pageContent'] .= '             </tr>';
    $data['pageContent'] .= '             <tr>';
    $data['pageContent'] .= '               <td>Occupation</td>';
    $data['pageContent'] .= '               <td><input type="text" name="update_occupation" value="' . $this->SearchData->getUsersOccupation(openssl_decrypt($_GET['id'],'AES-256-ECB',PASSWORD.$sessionData['users_id']))[0]->occupation . '" class="form-control"></td>';
    $data['pageContent'] .= '             </tr>';
    $data['pageContent'] .= '             <tr>';
    $data['pageContent'] .= '               <td>Company</td>';
    $data['pageContent'] .= '               <td><input type="text" name="update_company" value="' . $this->SearchData->getUsersCompany(openssl_decrypt($_GET['id'],'AES-256-ECB',PASSWORD.$sessionData['users_id']))[0]->company . '" class="form-control"></td>';
    $data['pageContent'] .= '             </tr>';
    $data['pageContent'] .= '             <tr>';
    $data['pageContent'] .= '               <td>Email Address</td>';
    $data['pageContent'] .= '               <td><input type="text" name="update_emailaddress" value="' . $this->SearchData->getUsersEmail(openssl_decrypt($_GET['id'],'AES-256-ECB',PASSWORD.$sessionData['users_id']))[0]->emailaddress . '" class="form-control"></td>';
    $data['pageContent'] .= '             </tr>';
    $data['pageContent'] .= '             <tr>';
    $data['pageContent'] .= '               <td>Birthdate</td>';
    $data['pageContent'] .= '               <td><input type="text" name="update_birthdate" value="' . $this->SearchData->getUsersBirthdate(openssl_decrypt($_GET['id'],'AES-256-ECB',PASSWORD.$sessionData['users_id']))[0]->birthday . '" class="form-control"></td>';
    $data['pageContent'] .= '             </tr>';
    $data['pageContent'] .= '           </tbody>';
    $data['pageContent'] .= '        </table>';
    $data['pageContent'] .= '           <div class=form-group">';
    $data['pageContent'] .= '             <input class="form-control btn-success" name="update" value="Update" type="submit">';
    $data['pageContent'] .= '           </div>';
  
}
$data['pageContent'] .= '        </div>';
$data['pageContent'] .= '      </div>';
        
        $this->load->view('SearchPage', $data);
        }
        else
            redirect(base_url.'index.php/auth','refresh');
    }
}
