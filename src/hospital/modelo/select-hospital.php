<?php

namespace conn;

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);

$HospitalDao = new HospitalDao;

$HospitalDao->select($id);