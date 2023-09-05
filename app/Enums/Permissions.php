<?php

namespace App\Enums;


enum Permissions: string
{
    case SHOW_USER = "show user";
    case CREATE_USER = "create user";
    case UPDATE_USER = "update user";
    case DELETE_USER = "delete user";
    case VIEW_USERS = "view users";

    case SHOW_PATIENT = "show patient";
    case CREATE_PATIENT = "create patient";
    case UPDATE_PATIENT = "update patient";
    case DELETE_PATIENT = "delete patient";
    case VIEW_PATIENTS = "view patients";

    case SHOW_PRESCRIPTION = "show prescription";
    case CREATE_PRESCRIPTION = "create prescription";
    case UPDATE_PRESCRIPTION = "update prescription";
    case DELETE_PRESCRIPTION = "delete prescription";
    case VIEW_PRESCRIPTIONS = "view prescriptions";
}
