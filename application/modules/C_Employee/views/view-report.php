<?php foreach($list as $key=>$val)
{
    echo "<tr>";
    echo "<td>$val->EmployeeName</td>";
    echo "<td>$val->DepartmentName</td>";
    echo "<td>".date('d F Y', strtotime($val->Date))."</td>";
    echo "<td>Rp. ".number_format($val->Value)."</td>";
    echo "</tr>";
} ?>
