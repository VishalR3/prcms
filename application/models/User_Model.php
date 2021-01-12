<?php

class User_Model extends CI_Model
{

  public function loginUser($mobile, $password)
  {
    $this->db->where('mobile', $mobile);
    $query = $this->db->get('users');

    if ($query && $query->num_rows() > 0) {
      $query = $query->row_array();
      $hash = $query['password'];
      if (password_verify($password, $hash)) {
        $user = $query;

        $data['success'] = TRUE;
        $data['user'] = $user;
        return $data;
      } else {
        $data['success'] = FALSE;
        $data['errors'] = 'Mobile or Password Incorrect';

        return $data;
      }
    } else {
      $data['success'] = FALSE;
      $data['errors'] = 'Mobile or Password Incorrect';

      return $data;
    }
  }

  public function handleFirstLogin($mobile, $password)
  {
    $this->db->set('password', $password);
    $this->db->set('active', '1');
    $this->db->where('mobile', $mobile);
    $query = $this->db->update('users ');

    if ($query) {
      return TRUE;
    }
    return FALSE;
  }

  public function registerUser($mobile, $password)
  {
    $data = array(
      'username' => $this->input->post('username'),
      'mobile' => $mobile,
      'password' => $password,
      'is_employee' => $this->input->post('is_employee'),
      'role' => $this->input->post('role')
    );
    if ($this->input->post('is_employee')) {
      $data['empID'] = $this->input->post('empID');
    }
    if ($this->db->insert('users', $data)) {
      return $this->db->insert_id();
    }
    return FALSE;
  }
  public function getUsers()
  {
    $query = $this->db->get('users');
    $users = array();
    if ($query && $query->num_rows() > 0) {
      $query = $query->result_array();
      foreach ($query as $row) {
        $user['user_id'] = $row['user_id'];
        $user['username'] = $row['username'];
        $user['mobile'] = $row['mobile'];
        $user['is_employee'] = $row['is_employee'];
        $user['role'] = $row['role'];
        if ($row['is_employee']) {
          $data = $this->em->getEmployee($row['empID']);
          $user['empID'] = $data['empID'];
          $user['data'] = $data;
        }

        array_push($users, $user);
      }
      return $users;
    }
    return FALSE;
  }
}