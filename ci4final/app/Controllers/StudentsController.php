<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentsModel;

class StudentsController extends BaseController
{
    public function index()
    {
        $fetchStudent = new StudentsModel();
        $data['students'] = $fetchStudent->findAll(); 
        return view('students/list', $data);
    }

    public function createStudent()
    {
        return view('students/add');
    }

    public function storeStudent()
    {
        $insertStudents = new StudentsModel(); 
        //store the student

        $data = array(
            'student_name' => $this->request->getPost('studentName'),
            'student_id' => $this->request->getPost('studentNum'),
            'student_section' => $this->request->getPost('studentSection'),
            'student_course' => $this->request->getPost('studentCourse'),
            'student_batch' => $this->request->getPost('studentBatch'),
            'student_grade_level' => $this->request->getPost('studentLevel'),
        );

        $insertStudents->insert($data);

        return redirect()->to('/students')->with('success', 'Student Added Successfully UWU!');
    }

    public function editStudent($id)
    {
        $fetchStudent = new StudentsModel();
        $data['student'] = $fetchStudent->where('id', $id)->first();
        return view('students/edit', $data);
    }

    public function updateStudent($id)
    {
        $updateStudent = new StudentsModel();
        //update the student
        $data = array(
            'student_name' => $this->request->getPost('studentName'),
            'student_id' => $this->request->getPost('studentNum'),
            'student_section' => $this->request->getPost('studentSection'),
            'student_course' => $this->request->getPost('studentCourse'),
            'student_batch' => $this->request->getPost('studentBatch'),
            'student_grade_level' => $this->request->getPost('studentLevel'),
        );

        $updateStudent->update($id,$data);

        return redirect()->to('/students')->with('success', 'Student Updated Successfully UWU!');
    }

    public function deleteStudent($id)
    {
        $deleteStudent = new StudentsModel();
        $deleteStudent ->delete($id);
        //delete the student

        return redirect()->to('/students')->with('success', 'Student Deleted Successfully UWU!');
    }
}

