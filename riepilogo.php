<?php


session_start();


function riepilogo(){
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=nomefile.csv');
    $output = fopen('php://output', 'w');
    foreach($_SESSION['todo_complete'] as $line){
      fputcsv($output, $line);
    }
    fclose($output);
  }

function riepilogo2(){
    $output2 = fopen('php://output2', 'w');
    foreach($_SESSION['completed'] as $line){
        fputcsv($output2, $line);
      }
    fclose($output2);
  }




riepilogo();
riepilogo2();








?>