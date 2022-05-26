<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vue js & PHP (Single Page Application)</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container my-3 " style="backgroud-color:grey;"  id="app">
        <h2 align="center">Vue.js  PHP (Single Page Application)</h2>
        <div class="row">
            <div class="col-md-12">
                <!-- <h1>{{message}}</h1> -->
                <form @submit="submitData" @reset="resetData" method="post">
                    <div class="form-group">
                        <label for="">ຊື່</label>
                        <input type="text" v-model="form.fname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">ນາມສະກຸນ</label>
                        <input type="text" v-model="form.lname" class="form-control">
                    </div>
                    <input type="submit" v-model="form.statu" class="btn btn-success mt-2">
                    <input type="reset" value="ຍົກເລີກ" class="btn btn-danger mt-2" >
                </form>
            </div>
        </div>
        <div class="py-2">
            {{form}}
        </div>
<!-- table -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ລຳດັບ</th>
                    <th scope="col">ຊື່</th>
                    <th scope="col">ນາມສະກຸນ</th>
                    <th scope="col">ແກ້ໄຂຂໍ້ມູນ</th>
                    <th scope="col">ລຶບຂໍ້ມູນ</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="row in users">
                    <th scope="row">{{row.id}}</th>
                    <td>{{row.fname}}</td>
                    <td>{{row.lname}}</td>
                    <td>
                        <button class="btn btn-primary" @click="editUser(row.id)">ແກ້ໄຂ</button>
                    </td>
                    <td>
                        <button class="btn btn-danger" @click="deleteUser(row.id)">ລຶບຂໍ້ມູນ</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
</body>

<script src="app.js"></script>
</html>