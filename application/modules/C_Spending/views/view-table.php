<?php foreach($list as $key=>$val)
{
    echo "<tr>";
    echo "<td class=text-center>".($key+1)."</td>";
    echo "<td>$val->EmployeeName</td>";
    echo "<td>$val->DepartmentName</td>";
    echo "<td>".date('d F Y', strtotime($val->Date))."</td>";
    echo "<td>Rp. ".number_format($val->Value, 2, '.', ',')."</td>";
    echo "<td hidden>$val->idPsening</td>";
    echo "<td hidden>$val->Value</td>";
    echo "<td hidden>$val->Date</td>";
    echo "<td>
            <button class='btn btn-danger btn-sm' onclick='deleted(".$val->idPsening.")'>Delete</button>
            <button class='btn btn-primary btn-sm open-modal'>Edit</button>
        </td>";
    echo "</tr>";
} ?>
