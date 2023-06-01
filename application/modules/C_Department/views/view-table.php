<?php foreach($list as $key=>$val)
{
    echo "<tr>";
    echo "<td>$val->ID</td>";
    echo "<td>$val->Name</td>";
    echo "<td>
            <button class='btn btn-danger btn-sm' onclick='deleted(".$val->ID.")'>Delete</button>
            <button class='btn btn-primary btn-sm open-modal'>Edit</button>
        </td>";
    echo "</tr>";
} ?>
