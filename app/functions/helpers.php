<?php

function dateFormat($date_str, $format) {
  return date_format(date_create($date_str), $format);
}

function authRoleName() {
  if(Auth::user()->role == 1) {
    $user_role = Illuminate\Support\Facades\DB::table('model_has_roles')
      ->where('model_id', Auth::id())
      ->join('roles', 'model_has_roles.role_id', 'roles.id')
      ->select('roles.name as role_name')
      ->first();
      return $user_role->role_name;
  }
}

