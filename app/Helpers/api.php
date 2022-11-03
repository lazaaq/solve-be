<?php

function responseAPI($status, $success, $data=null, $message=null) {
    return response()->json([
        'status' => $status, // status code
        'success' => $success, // boolean
        'result' => $data,
        'message' => $message
    ]);
}

function getApiHost() {
    return "http://localhost:8000";
}