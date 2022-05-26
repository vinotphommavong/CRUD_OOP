var app = new Vue({
    el: '#app',
    data: {
        users:"",
        message: 'Hello Vue!',
        form:{
            id:"",
            fname:"",
            lname:"",
            isEdit:false,
            statu:"ບັນທຶກ",
        }
        
    },
    methods:{
        submitData(e){
            e.preventDefault();
            //console.log("ບັນທຶກຂໍ້ມູນ");
            check = (this.form.fname !="" && this.form.lname !="" )
            if(check && !this.form.isEdit){
                //ບັນທຶກຂໍ້ມູນແລ້ວສົ່ງໄປບັນທຶກທີຖານຂໍ້ມູນ
                axios.post("action.php",{
                    fname:this.form.fname,
                    lname:this.form.lname,
                    action:"insert"
                }).then(function(res){
                    //console.log("ບັນທຶກແລ້ວ");//ກວດສອບໃນconsole browser
                    //console.log(res.data);//ກວດສອບໃນconsole browser
                    app.resetData();   // reset ຂໍ້ມູນໃນຝອມ ຫລັງຈາກບັນທຶກລົງຖານຂໍ້ມູນ
                    app.getAllUsers(); //ສະແດງຂໍ້ມູນໃນຕາລາງ ຫຼັງຈາກບັນທຶກລົງໃນຖານຂໍ້ມູນ
                })
            }
            //console.log(this.form.fname);
            //console.log(this.form.lname);
            
           
            if(check && this.form.isEdit){
            //ອັບເດດຂໍ້ມູນ
               //console.log("Update  data");

               axios.post("action.php",{
                id:this.form.id,
                fname:this.form.fname,
                lname:this.form.lname,
                action:"update"
            }).then(function(res){
                alert(res.data.message);
                app.resetData();   // reset ຂໍ້ມູນໃນຝອມ ຫລັງຈາກບັນທຶກລົງຖານຂໍ້ມູນ
                app.getAllUsers(); //ສະແດງຂໍ້ມູນໃນຕາລາງ ຫຼັງຈາກບັນທຶກລົງໃນຖານຂໍ້ມູນ
            })
            }

        },
        resetData(){
            //e.preventDefault();
            //console.log("ລ້າງຂໍ້ມູນ");
            this.form.id="";
            this.form.fname="";
            this.form.lname="";
            this.form.statu="ບັນທຶກ";
            this.form.isEdit="false";
            
        },
        getAllUsers(){
            axios.post("action.php",{
                action:"getAll"
            }).then(function(res){
                //console.log(res);
                app.users=res.data
                //console.log(this.users);
            })
        },
        editUser(id){
            //console.log(id);
            this.form.statu="ອັບເດດ";
            this.form.isEdit=true;

            axios.post("action.php",{
                action:"getEditUser",
                id:id
            }).then(function(res){
                //console.log(res.data.fname);
                
                app.form.id=res.data.id;
                app.form.fname=res.data.fname;
                app.form.lname=res.data.lname;
            })
        },

        deleteUser(id){
            if(confirm("ເຈົ້າຕ້ອງການລຶບລະຫັດທີ"+id+"ແມ່ນບໍ່ ?")){
                axios.post("action.php",{
                    action:"deleteUser",
                    id:id
                }).then(function(res){
                    console.log(res.data);
                    alert(res.data.message);
                    app.resetData();
                    app.getAllUsers();
                })
            }
        }
    },

    created(){
        this.getAllUsers();
    }
})