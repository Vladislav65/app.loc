<?php

/* Массив маршрутов для роутинга */

return array(
    '^/*$' => "site/index",
    "about" => "about/index", // метод actionIndex в контроллере about
    "courses([0-9]+)" => "courses/view/$1",
    "coursesS([0-9]+)" => "courses/start/$1",
    "courses" => "courses/index", // метод actionIndex в контроллере cources
    "topic([0-9]+)" => "topics/view/$1",
    "mentors([0-9]+)" => "mentors/view/$1",
    "mentorsT" => "mentors/test",
    "mentors" => "mentors/index",
    "mentorM" => "mentors/main",
    "mentorGr" => "mentors/createGroup",
    "mentorMyGroups" => "mentors/viewGroups",
    "inviteStudents([0-9]+)" => "mentors/inviteStudents/$1",
    "sendInvitation([0-9]+)" => "mentors/sendInvitation/$1",
    "userR" => "user/register",
    //user/mentorReg" => "user/mentorReg",
    "userA" => "user/auth",
    "userMR" => "user/mentorReg",
    "admin" => "admin/index",
    "delStudent([0-9]+)" => "admin/deleteStudent/$1",
    "delMentor([0-9]+)" => "admin/deleteMentor/$1",
    "courseadd" => "admin/courseAdd",
    "mentorCourseAdd" => "mentors/courseAdd/$1",
    "coursecontrol" => "admin/coursesControl",
    "usercontrol" => "admin/userControl",
    "courseAdmin([0-9]+)" => "admin/courseAdmin/$1",
    "deleteCourse([0-9]+)" => "admin/deleteCourse/$1",
    "topicAdd([0-9]+)" => "admin/topicAdd/$1",
    "graph" => "admin/graph",
    "savefile" => "admin/saveFile",
    "addStudent" => "admin/addStudent",
    "testAdd([0-9]+)" => "admin/testAdd/$1",
    "dotest([0-9]+)" => "tests/doTest/$1",
    "testResults" => "tests/getResult/$1",
    "student" => "student/index",
    "join([0-9]+)" => "student/join/$1",
    "decline([0-9]+)" => "student/decline/$1",
    "groups" => "student/groups",
    "makeOffer([0-9]+)" => "student/makeOffer/$1",
    "offerResult" => "student/offerResult",
    "viewInvitations" => "student/invitations",
    "userL" => "user/logout",
    "userLA" => "user/logoutAdmin"
);