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
        if ($query['is_employee']) {
          $empData = $this->em->getEmployee($query['empID']);
          $user['empData'] = $empData;
        } else {
          $contData = $this->mm->getContractorByID($query['empID']);
          $user['contData'] = $contData;
        }
        $user['access'] = $this->getPermissions($query['role']);

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
      return array('insert_id' => $this->db->insert_id());
    }
    return FALSE;
  }
  public function getUsers()
  {
    $this->db->from('users t1');
    $this->db->join('roles t2', 't2._id=t1.role');
    $query = $this->db->get('');
    $users = array();
    if ($query && $query->num_rows() > 0) {
      $query = $query->result_array();
      foreach ($query as $row) {
        $user['user_id'] = $row['user_id'];
        $user['username'] = $row['username'];
        $user['mobile'] = $row['mobile'];
        $user['is_employee'] = $row['is_employee'];
        $user['role'] = $row['role'];
        $user['role_color'] = $row['roleColor'];
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
  public function addRole()
  {
    $data = array(
      'role' => $this->input->post('role'),
      'access' => $this->input->post('access'),
      'roleColor' => $this->input->post('roleColor')
    );
    $query = $this->db->insert('roles', $data);
    if ($query)
      return TRUE;

    return FALSE;
  }
  public function getRoles()
  {
    $this->db->order_by('_id', 'DESC');
    $query = $this->db->get('roles');
    if ($query && $query->num_rows() > 0)
      return $query->result_array();
    return FALSE;
  }
  public function updateUser($id)
  {
    foreach ($this->input->post() as $key => $value) {
      $data[$key] = $value;
    }
    $this->db->where('user_id', $id);
    $query = $this->db->update("users", $data);

    if ($query)
      return TRUE;
    return FALSE;
  }
  public function deleteUser($id)
  {

    $this->db->where('user_id', $id);
    $query = $this->db->delete("users");

    if ($query)
      return TRUE;
    return FALSE;
  }
  public function getUserByID($id)
  {
    $this->db->where('user_id', $id);
    $query = $this->db->get("users");

    if ($query && $query->num_rows() > 0)
      return $query->row_array();
    return FALSE;
  }
  public function getPermissions($id)
  {
    $this->db->where('_id', $id);
    $query = $this->db->get('roles');

    if ($query && $query->num_rows() > 0) {
      $permissions = $query->row_array()['access'];

      return $permissions;
    }
    return FALSE;
  }
}
