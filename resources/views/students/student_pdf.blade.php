<!DOCTYPE html>
<html>

<head>
    
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #a51e1e;
            color: white;
        }
        .mb-20{
            margin-bottom: 20px;
        }
        .mt_60{
            margin-top: 60px;
        }
        .mr_20{
            margin-right: 20px;
        }
        .brdr{
            border-bottom: 1px solid black;
            border-top: 1px solid black;
            padding: 0px;
            text-align: center;
        }
        .w40{
            width: 40%;
        }
        .w60{
            width: 60%;
        }
        .right{
            text-align: right;

        }
        .font_arial{
            font-family: Arial, Helvetica, sans-serif;
        }

    </style>
</head>

<body>
    <div class="brdr font_arial">
        <p>Profile</p>
    </div>
    <div class="font_arial">
        <p>{{ $student['first_name'] }}</p>
    </div>

    <table id="customers">
        <tr>
            <td class="w40">Admission No</td>
            <td class="w60">{{ $student['id'] }}</td>
        </tr>
        <tr>
            <td class="w40">Admission Date</td>
            <td>{{ $student['created_at'] }}</td>
        </tr>
        <tr>
            <td class="w40">Batch</td>
            <td>{{ $student['batch']['batch_name'] }}</td>
        </tr>
        <tr>
            <td class="w40">Course</td>
            <td></td>
        </tr>
        <tr>
            <td class="w40">Date of birth</td>
            <td>{{ $student['dob'] }}</td>
        </tr>
        <tr>
            <td class="w40">Blood group</td>
            <td>{{ $student['bloodgroup'] }}</td>
        </tr>
        <tr>
            <td class="w40">Gender</td>
            <td>{{ $student['gender'] }}</td>
        </tr>
        <tr>
            <td class="w40">Nationality</td>
            <td>{{ $student['nationality'] }}</td>
        </tr>
        <tr>
            <td>Mother tongue</td>
            <td>{{ $student['mother_tongue'] }}</td>
        </tr>
        <tr>
            <td class="w40">Category</td>
            @if ($student['category']!=null)
            <td>{{ $student['category']['title'] }}</td>
            @else
                <td></td>
            @endif
            
        </tr>
        <tr>
            <td class="w40">Religion</td>
            <td>{{ $student['religion'] }}</td>
        </tr>

        <tr>
            <td class="w40">Address</td>
            <td>{{ $student['address']['address_one'], $student['address']['address_two'] }}</td>
        </tr>
        <tr>
            <td class="w40">City</td>
            <td>{{ $student['address']['city'] }}</td>
        </tr>
        <tr>
            <td class="w40">State</td>
            <td>{{ $student['address']['state'] }}</td>
        </tr>
        <tr>
            <td class="w40">Pin code</td>
            <td>{{ $student['address']['pin_code'] }}</td>
        </tr>
        <tr>
            <td class="w40">Country</td>
            <td>{{ $student['address']['country'] }}</td>
        </tr>
        
        <tr>
            <td class="w40">Birth place</td>
            <td>{{ $student['birthplace']}}</td>
        </tr>
        <tr>
            <td class="w40">Phone</td>
            <td>{{ $student['address']['phone'] }}</td>
        </tr>
        <tr>
            <td class="w40">Mobile</td>
            <td>{{ $student['address']['mobile'] }}</td>
        </tr>
        <tr>
            <td class="w40">Biometric ID</td>
            <td>{{ $student['biometric_id'] }}</td>
        </tr>
        <tr>
            <td class="w40">Email</td>
            <td>{{ $student['address']['email'] }}</td>
        </tr>
        
    </table>
    <div class="right font_arial mt_60 mr_20">
        <p>Signature</p>
    </div>

</body>

</html>

