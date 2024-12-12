<!--Done by
Osama Anwar Alansari      202103778
Mohammed Hussain Haouas   20194952-->
<?php
// Fetch data from the API
$URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";
$response = file_get_contents($URL);
$result = json_decode($response, true);

// Group data by year and semester
$groupedData = [];
foreach ($result['results'] as $rs) {
    $groupedData[$rs['year']][$rs['semester']][] = $rs;
}
// Function to sort rows by nationality
function sortByNationality($a, $b) {
    $order = ['Bahraini', 'GCC National', 'Other'];
    $posA = array_search($a['nationality'], $order);
    $posB = array_search($b['nationality'], $order);
    return $posA - $posB;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--- Add styling --->
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.min.css">
    <link rel="stylesheet" href="style.css">
    <title>UOB Data API</title>
</head>
<body>
    <h1>Number of students enrolled in bachelor programs in college of IT, UoB</h1>
    <div class = "overflow-auto">    
    <!--- Display the data in a table --->
    <table>
        <thead data-theme = "dark">
            <tr>
                <th>Year</th>
                <th>Semester</th>
                <th>Nationality</th>
                <th>Number of students</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach ($groupedData as $year => $semesters):
            $yearRowCount = array_sum(array_map('count', $semesters));
            $yearPrinted = false;
            foreach ($semesters as $semester => $rows):
                usort($rows, 'sortByNationality');
                $semesterRowCount = count($rows);
                foreach ($rows as $index => $rs):?>
                    <tr>
                    <?php if (!$yearPrinted):?>
                        <td rowspan = <?php echo $yearRowCount; ?> > <?php echo $year; ?> </td>
                        <?php $yearPrinted = true;
                    endif;
                    if ($index == 0): ?>
                        <td rowspan= <?php echo $semesterRowCount; ?> > <?php echo $semester; ?> </td>
                    <?php endif; ?>
                    <td> <?php echo $rs['nationality']; ?> </td>
                    <td> <?php echo $rs['number_of_students']; ?> </td>
                    </tr>
                <?php endforeach;
            endforeach;
        endforeach;
        ?>
        </tbody>
    </table>
    </div>
</body>
</html>
