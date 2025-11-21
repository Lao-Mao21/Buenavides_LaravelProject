<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{ 
    public function index() //show all courses in the database and display the data
    {
        $courses = Course::latest()->get(); //add your model to fetch data
        return view('course', compact('courses')); //add a view in app/resources/views
    }
    public function store(Request $request) //input data into the database, validates it first
    {
        $validated = $request->validate([
            'course_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]); //add validation req for storing data and selecting the columns

        Course::create($validated); //validate data input
        return redirect()->back()->with('success', 'Course added sucessfully.'); //redirect to previous page and display sucess msg
    }
    public function update(Request $request, Course $course) // updates the database
    {
        $validated = $request->validate([
            'course_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]); //same thing as store but for updates

        $course->update($validated); //validate update
        return redirect()->back()->with('sucess', 'Course updated sucessfully.'); //redirect to previous page and display sucess msg
    }
    public function destroy(Course $course) //deletes data in the database
    {
        $course->delete(); //delete data
        return redirect()->back()->with('sucess', 'Course added sucessfully.'); //redirect to previous page and display sucess msg
    }
}
