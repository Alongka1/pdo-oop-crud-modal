<?php 

    require_once "./includes/users.php";
    require_once "./includes/util.php";

    $db = new Users();
    $util = new Util();

    if (isset($_POST['add'])) {
        $fname = $util->testInput($_POST['fname']);
        $lname = $util->testInput($_POST['lname']);
        $email = $util->testInput($_POST['email']);
        $phonenumber = $util->testInput($_POST['phonenumber']);

        if ($db->insert($fname, $lname, $email, $phonenumber)) {
            echo $util->showMessage("success", "User inserted successfully!");
        } else {
            echo $util->showMessage("danger", "Something went wrong!");
        }
    }

    if (isset($_GET['read'])) {
        $users = $db->read();
        $output = '';
        if ($users) {
            foreach($users as $row) {
                $output .= '<tr>
                            <td>' . $row['id'] . '</td>
                            <td>' . $row['firstname'] . '</td>
                            <td>' . $row['lastname'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['phonenumber'] . '</td>
                            <td>
                                <a href="#" id="'. $row['id'] .'" class="btn btn-success btn-sm rounded-pull py-0 editlink" data-bs-toggle="modal" data-bs-target="#editUserModal">Edit</a>
                                <a href="#" id="'. $row['id'] .'" class="btn btn-danger btn-sm rounded-pull py-0 deletelink">Delete</a>
                            </td>
                </tr>';
            }
            echo $output;
        } else {
            echo '<tr>
                <td colspan="6">No users found in the Database</td>
            </tr>';
        }
    }

    if (isset($_GET['edit'])) {
        $id = $_GET['id'];
        $user = $db->readOne($id);
        echo json_encode($user);
    }

    if (isset($_POST['update'])) {
        $id = $util->testInput($_POST['id']);
        $fname = $util->testInput($_POST['fname']);
        $lname = $util->testInput($_POST['lname']);
        $email = $util->testInput($_POST['email']);
        $phonenumber = $util->testInput($_POST['phonenumber']);

        if ($db->update($id, $fname, $lname, $email, $phonenumber)) {
            echo $util->showMessage("success", "User updated successfully!");
        } else {
            echo $util->showMessage("danger", "Something went wrong!");
        }
    }

    if (isset($_GET['delete'])) {
        $id = $_GET['id'];
        if ($db->delete($id)) {
            echo $util->showMessage("info", "User deleted successfully!");
        } else {
            echo $util->showMessage("danger", "Something went wrong!");
        }
    }

?>