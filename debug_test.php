<?php
function addNumbers($a, $b)
{
  return $a + $b;
}

$numbers = [1, 2, 3, 4, 5];
$total = 0;
foreach ($numbers as $num) {
  $total = addNumbers($total, $num); // <-- set a breakpoint here in VSCode
}
echo "Final total is: $total<br>";
