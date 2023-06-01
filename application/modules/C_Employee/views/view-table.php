<?php foreach($list as $key=>$val)
{
    echo "<tr>";
    echo "<td>$val->IDEmployee</td>";
    echo "<td>$val->NAME_Employee</td>";
    echo "<td>$val->Name_Department</td>";
    echo "<td hidden>$val->DeptID</td>";
    echo "<td>
            <button class='btn btn-danger btn-sm' onclick='deleted(".$val->IDEmployee.")'>Delete</button>
            <button class='btn btn-primary btn-sm open-modal'>Edit</button>
        </td>";
    echo "</tr>";
} ?>
