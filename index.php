<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        table,
        th,
        td {
            border: 2px solid green;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
        }
    </style>
    <title>Tailwind CSS Form</title>
</head>

<body class="bg-gray-200 p-6">

    <div class="max-w-md mx-auto bg-white p-8 border rounded-md shadow-md">

        <h2 class="text-2xl font-semibold mb-4">Example Form</h2>

        <!-- Form Validation with PHP -->
        <?php

        // first check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            // echo "submitted<br>";

            // $name = isset($_POST["name"]) ? $_POST["name"] : "no name";
            $name = !empty($_POST["name"]) ? htmlspecialchars($_POST["name"]) : "";
            $gender = !empty($_POST["gender"]) ? htmlspecialchars($_POST["gender"]) : "";
            $subscribe = !empty($_POST["subscribe"]) ? "Yes" : "No";
            $datepicker = !empty($_POST["datepicker"]) ? htmlspecialchars($_POST["datepicker"]) : "";
            $timepicker = !empty($_POST["timepicker"]) ? htmlspecialchars($_POST["timepicker"]) : "";
            $options = !empty($_POST["options"]) ? $_POST["options"] : [];
            $multicheckbox = !empty($_POST["multicheckbox"]) ? $_POST["multicheckbox"] : [];
            $country = !empty($_POST["country"]) ? htmlspecialchars($_POST["country"]) : "";

            $option_string = implode(",", $options);
            $checkbox_string = implode(",", $multicheckbox);

            $info = <<<INFO
            <div>
            <h1 class="text-center text-xl">Submitted Data</h1>
            <table class="w-full text-left border-2 border-solid border-red-500 mt-2 mb-5">
            <tr>
                <th>Name</th>
                <td>::::</td>
                <td class="pl-2">$name</td>
            </tr>
            <tr>
                <th>Gender</th>
                <td>::::</td>
                <td class="pl-2">$gender</td>
            </tr>
            <tr>
                <th>Subscription Status</th>
                <td>::::</td>
                <td class="pl-2">$subscribe</td>
            </tr>
            <tr>
                <th>Date</th>
                <td>::::</td>
                <td class="pl-2">$datepicker</td>
            </tr>
            <tr>
                <th>Time</th>
                <td>::::</td>
                <td class="pl-2">$timepicker</td>
            </tr>
            <tr>
                <th>Selceted Options</th>
                <td>::::</td>
                <td class="pl-2">$option_string</td>
            </tr>
            <tr>
                <th>Checkbox Options</th>
                <td>::::</td>
                <td class="pl-2">$checkbox_string</td>
            </tr>
            <tr>
                <th>Country</th>
                <td>::::</td>
                <td class="pl-2">$country</td>
            </tr>
        </table>
     
        </div>      
        INFO;

            echo $info;
        } else {
            echo "<h1 style='color:red'>This is Initial Loading</h1>";
        }

        ?>

        <form action="#" method="post">

            <!-- Text Input -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-600">Name</label>
                <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded-md" value="<?php echo $name ?? '' ?>">
            </div>

            <!-- Radio Buttons -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600">Gender</label>
                <div class="mt-1 space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="gender" value="Male" class="form-radio text-indigo-600" <?php echo ($gender ?? '')  === 'Male' ? 'checked' : ''; ?>>
                        <span class="ml-2">Male</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="gender" value="Female" class="form-radio text-indigo-600" <?php echo ($gender ?? '') === 'Female' ? 'checked' : ''; ?>>
                        <span class="ml-2">Female</span>
                    </label>
                </div>
            </div>

            <!-- Checkbox -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600">Subscribe to Newsletter</label>
                <input type="checkbox" id="subscribe" name="subscribe" class="form-checkbox text-indigo-600" <?php echo ($subscribe ?? '') === "Yes" ? 'checked' : ''; ?>>
            </div>

            <!-- Date Picker -->
            <div class="mb-4">
                <label for="datepicker" class="block text-sm font-medium text-gray-600">Pick a Date</label>
                <input type="text" id="datepicker" name="datepicker" class="mt-1 p-2 w-full border rounded-md" value="<?php echo $datepicker ?? '' ?>">
            </div>

            <!-- Time Picker -->
            <div class="mb-4">
                <label for="timepicker" class="block text-sm font-medium text-gray-600">Pick a Time</label>
                <input type="text" id="timepicker" name="timepicker" class="mt-1 p-2 w-full border rounded-md" value="<?php echo $timepicker ?? '' ?>">
            </div>

            <!-- Multiselect Dropdown using Select2 -->
            <div class="mb-4">
                <label for="options" class="block text-sm font-medium text-gray-600">Select Options</label>
                <select id="options" name="options[]" class="mt-1 p-2 w-full border rounded-md" multiple>
                    <option value="option1" <?php echo in_array('option1', $options ?? []) ? "selected" : ""  ?>>Option 1</option>
                    <option value="option2" <?php echo in_array('option2', $options ?? []) ? "selected" : ""  ?>>Option 2</option>
                    <option value="option3" <?php echo in_array('option3', $options ?? []) ? "selected" : ""  ?>>Option 3</option>
                </select>
            </div>

            <!-- Multi-checkbox -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600">Select Multiple Options</label>
                <div class="space-y-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="multicheckbox[]" value="checkbox1" class="form-checkbox text-indigo-600" <?php echo in_array('checkbox1', $multicheckbox ?? []) ? "checked" : ""  ?>>
                        <span class="ml-2">Checkbox 1</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="multicheckbox[]" value="checkbox2" class="form-checkbox text-indigo-600" <?php echo in_array('checkbox2', $multicheckbox ?? []) ? "checked" : ""  ?>>
                        <span class="ml-2">Checkbox 2</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="multicheckbox[]" value="checkbox3" class="form-checkbox text-indigo-600" <?php echo in_array('checkbox3', $multicheckbox ?? []) ? "checked" : ""  ?>>
                        <span class="ml-2">Checkbox 3</span>
                    </label>
                </div>
            </div>

            <!-- Select Dropdown -->
            <div class="mb-4">
                <label for="country" class="block text-sm font-medium text-gray-600">Country</label>
                <select id="country" name="country" class="mt-1 p-2 w-full border rounded-md">
                    <option value="United States" <?php echo ($country ?? '')  === 'United States' ? "selected" : ""  ?>>United States</option>
                    <option value="Canada" <?php echo ($country ?? '') === "Canada" ? "selected" : ""  ?>>Canada</option>
                    <option value="United Kingdom" <?php echo ($country ?? '')  === 'United Kingdom' ? "selected" : ""  ?>>United Kingdom</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="bg-indigo-600 text-white p-2 rounded-md">Submit</button>
            </div>

        </form>

    </div>

    <script>
        // Initialize Select2 for the multiselect dropdown
        $(document).ready(function() {
            $('#options').select2();
        });

        // Initialize Flatpickr for the date and time pickers
        flatpickr("#datepicker", {
            enableTime: false,
            dateFormat: "Y-m-d",
        });

        flatpickr("#timepicker", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });
    </script>

</body>

</html>