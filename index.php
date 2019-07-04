
<h1>JavaScript</h1><h3>Калькулятор</h3>
    <p>Делать калькулятор с двумя input легко, я использую 1 поле input.  
Поле input принимает числа и символы операций, после с помощью регулярных выражений парсит их на 2 массива, массив значений и массив символов. При вычислении массивы соединяются в определенной последовательности,  все это позволяет  проводить вычисления всего из 1 поля ввода input.
Также есть проверка на ошибки, на ввод нескольких операций вместе или букв и спец символов, принимаются только числа.
</p>
    
    <form name="panel_calc" class="panel" style="height: 470px;">
        <p>Калькулятор</p>
        
        <input name="RESULT" id="inp_inform" placeholder="Вводите ваши данные">    
        <div class="panel_button" onclick="func_dob('+')">+</div>     
        <div class="panel_button" onclick="func_dob('-')">-</div>    
        <div class="panel_button" onclick="func_dob('*')">*</div>    
        <div class="panel_button" onclick="func_dob('/')">/</div>    
        <div class="panel_button" onclick="func_dob(1)">1</div>    
        <div class="panel_button" onclick="func_dob(2)">2</div>    
        <div class="panel_button" onclick="func_dob(3)">3</div>    
        <div class="panel_button" onclick="func_dob(4)">4</div>     
        <div class="panel_button" onclick="func_dob(5)">5</div>    
        <div class="panel_button" onclick="func_dob(6)">6</div>     
        <div class="panel_button" onclick="func_dob(7)">7</div>     
        <div class="panel_button" onclick="func_dob(8)">8</div>     
        <div class="panel_button" onclick="func_dob(9)">9</div>     
        <div class="panel_button" onclick="func_dob(0)">0</div>
        <div class="panel_button" onclick="func_dob('.')">.</div>

        <div name="btn_result" class="panel_button" id="btn_result" style="width: 90%;"
        onclick="func_result()">
            <strong>=</strong></div>
        
        <div name="btn_clean" class="panel_button" id="btn_clean" style="width: 90%;"
        onclick="func_clean()">
            <strong>Clean</strong></div>
    </form>
    
  <div id="DIV_RESULT">
  </div>
    
  <div id="Errors">
  </div>
    



<script type="text/javascript">
    "use strict";
//-----------------------------------------------------//
    var inp_res = document.panel_calc.RESULT;
    var div_res = document.getElementById("DIV_RESULT");
    // Кнопка ОК прячет блок вывода ошибок
    function func_er_ok(){
        document.getElementById("Errors").style.visibility="hidden";
    }
//-----------------------------------------------------//
    // Вывод результатов
    function func_result(){
        // Массив для принятим подмассивов с ошибками
        var mass_erros = [];
        // Регулярн выражения на проверку прав введ математ выражения
        let reg3 = /[,!@#$%^&\\№;:?_`~]/g;//Ищет все недопуст символы
        let reg4 = /[a-z]/ig;// Все буквы алфавита
        let reg5 = /[+-/*/]{2,100}/;//все повторения операций -- ** //
        let reg6 = /[+-/*/]{1,100}$/;// операция в конце
        let reg7 = /^[+-/*/]{1,100}/;// операция в начале
        
        // Сам поиск рег.вар в веденной строке
        var m_r_1 = inp_res.value.match(reg3);
        var m_r_2 = inp_res.value.match(reg4);
        var m_r_3 = inp_res.value.match(reg5);
        var m_r_4 = inp_res.value.match(reg6);
        var m_r_5 = inp_res.value.match(reg7);
        
        //Занесение ошибок каждую в свой спец массив
        if(m_r_1 !=null){  
            mass_erros[mass_erros.length] = "Запрещенный символ :  "+m_r_1;  
        }
        if(m_r_2 !=null){
            mass_erros[mass_erros.length] = "Буквы недопустимы :  "+m_r_2;  
        }
        if(m_r_3 !=null){
            mass_erros[mass_erros.length] = "Недопустимые повторения : "+m_r_3;  
        }
        if(m_r_4 !=null){
            mass_erros[mass_erros.length] = "Неправильное окончание : "+m_r_4;  
        }
        if(m_r_5 !=null){
            mass_erros[mass_erros.length] = "Неправильное начало : "+m_r_5;  
        }
        
        
        
        
        //Проверка Большого Массива если есть хоть какиелмбо ошибки
        // вывод окна висибл - вывод кнопки -и всех подмассивов
        if(mass_erros[0] != null ){
            document.getElementById("Errors").style.visibility="visible";
            document.getElementById("Errors").innerHTML = "<div id='er_1'>Ошибка !</div><br>";
            document.getElementById("Errors").innerHTML +="<div id='er_ok' onclick='func_er_ok()' >ok</div>";
            for(let i =0; i<mass_erros.length ;i++){
              document.getElementById("Errors").innerHTML+=
                  "<strong>"+mass_erros[i]+"</strong><br><br>";  
            }
        }else{
            
        // Рег выражения поиска всех символов обычн / дробн    
        var reg1 = /\d+(\.\d+)?/g;
        // Поиск всех операций
        var reg2 = /[+-/*/]/g;
        
        // Занесение результ в свои массивы
        var mass1 = inp_res.value.match(reg1);
        var mass2 = inp_res.value.match(reg2);
        // Спец переменные для цикла вывода
        var i=0;  
        var p=1;    
        var k=0;    
        var NUMB=0;
        var Q = mass1.length;
        // Цикл Вывода 1_число + операция + 2_число и так до конца
        while(i<=Q){
            if(mass2[k]=="+"){
                NUMB = Number(mass1[i])+Number(mass1[p]);  
            }
            if(mass2[k]=="-"){
                NUMB = Number(mass1[i])-Number(mass1[p]);
            }
            if(mass2[k]=="*"){
                NUMB = Number(mass1[i])*Number(mass1[p]);
            }
            if(mass2[k]=="/"){
                NUMB = Number(mass1[i])/Number(mass1[p]);
            }
            k++;   i++;   p++;   
            mass1[i] = NUMB;
        }
        // Вывод результата 
        div_res.innerHTML +="<h3>Результат = "+NUMB+"</h3>";
    }
}
    
//-----------------------------------------------------//
    // Очистка полей вывода
    function func_clean(){
       document.getElementById("DIV_RESULT").innerHTML='';
       inp_res.value ='';
    }
//-----------------------------------------------------//
    // Добавление значений в поля
    function func_dob(calc_number){
         inp_res.value += calc_number;
    }
//-----------------------------------------------------//
</script>








<style type="text/css"> 
    #Errors{
        width: 420px; height: auto; min-height: 170px;
        background-color: whitesmoke; color: black;
        border-radius: 12px;border: 8px solid rgb(221,68,54);
        position: absolute;top: 200px; left: 200px;
        visibility: hidden; 
        text-indent: 10px;
        font-size: 18px; 
        font-weight: bold;
    }
    #er_1{
        text-align: center; 
        line-height: 30px;
        width: 100%;
        height: 30px;
        background-color: rgba(221,68,54,0.7);
        font-size: 1.7em; 
        text-shadow: 0px 0px 1px #393B31; 
    }
    #er_ok{
        float: right;
        margin: 10px;
        width: 45px; height: 45px;
        border-radius: 6px; text-align: center;
        line-height: 45px; color: #2B3238; cursor: pointer;
        font-size: 1.5em; text-shadow: 0px 0px 1px #393B31; 
        background-color: #6DD550;
        box-shadow: 2px 2px 5px 2px #376B28;
    }
    #er_ok:hover{
        background-color: #4C9438;
    }
    #er_ok:active{
        color:  #2B3238;
        background: linear-gradient(rgba(0,0,0,.2), rgba(0,0,0,.1));
        box-shadow:
        inset rgba(0,0,0,.8) 0 1px 2px,
        inset rgba(0,0,0,.05) 0 -1px 0,
        #fff 0 1px 1px;
        background-color: #4C9438;
    }
    
    
    
    
    #DIV_RESULT{
        width: 400px;
        min-height: 500px;
        height: auto; 
        position: absolute;
        top: 220px; 
        left: 100px;
        background-color: rgba(255,238,85,0.8);
        margin-left: 30%; 
        border-radius: 20px;
        font-size: 1.6em; 
        text-align: center; /*  line-height: 300px;  */
        margin-top: 80px;
    }
    
      /*---------------------------------------*/
    .DIV_MAIN{

    }
    #DIV_1{
        height: 400px;  border-radius: 10px;
        position: absolute; background-color: rgb(245,255,199);
        visibility: visible; transition: 0.5s;
        box-shadow: 0px 0px 20px 10px rgb(43,50,56);
        border: 4px solid rgb(43,50,56); 
    }
    /*---------------------------------------*/
    .panel{
        margin: 10px;
        background-color: rgb(43,50,56); border-radius: 9px;
        width: 300px; height: auto;
        box-shadow: 5px 5px 12px 5px rgb(32,37,42);
    }
    .panel p{
        color: whitesmoke;text-align: center; padding: 10px;
    }
    .panel input{
        width: 80%; margin-left: 10%; border: 0; 
        border-radius: 6px;height: 35px; margin-top: 10px;
        background-color: rgb(59,65,72); 
         text-indent: 10px;
        font-size: 17px;color:white;
    }
     .panel input:focus{
        color: whitesmoke;
        outline: 0;
    }
    .panel_button{
        font-weight: bold;
        transition: 0.1s;
        background-color: rgb(0,200,250); 
        color: rgb(43,50,56);
        height: 37px;cursor: pointer;
        line-height: 37px;
        box-shadow: 0px 0px 0px 0px ;margin: 10px;
        text-align: center;border: 0px; 
        border-radius: 6px;  font-size: 18px; 
        width: 15%; margin-left: 5%; float: left;
    }
    .panel_button:hover{
          background-color: rgb(0,138,174);
    }
    .panel_button:focus{
        outline: 0;
    }
    .panel_button:active{
        color: whitesmoke;
        background: linear-gradient(rgba(0,0,0,.2), rgba(0,0,0,.1));
        box-shadow:
        inset rgba(0,0,0,.8) 0 1px 2px,
        inset rgba(0,0,0,.05) 0 -1px 0,
        #fff 0 1px 1px;
    }
    h1, h2, h3, h4, h5, h6{
		color: #171814; 
		text-align: center;
		text-shadow: 0px 0px 1px #171814;
	}
	p{ 
		color: #171814; 
		text-shadow: 0px 0px 1px #171814; 
		font-size: 18px; 
	}
	hr{
		border: 1px solid black;
	}
	pre{
		color: #FF3C4F; 
		font-size: 15px;
		text-shadow: 0px 0px 1px #FF3C4F; 
	}
</style>





















