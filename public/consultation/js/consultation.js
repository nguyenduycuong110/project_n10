(function($) {
	"use strict";
	var HT = {}; 
    var _token = $('meta[name="csrf-token"]').attr('content');
    var typingTimer;
    var doneTyingInterval = 300;


    HT.openNewWindow = () => {
        $(document).on('click','.btn-new-wd', function(e){
            e.preventDefault();
            let _this = $(this)
            let url = $(this).attr('href'); 
            let windowName = 'popupWindow'; 
            let windowFeatures = `width=1300px,height=700px,left=50%,top=50%,resizable=yes,scrollbars=yes,status=yes`;
            window.open(url, windowName, windowFeatures);
        })
    }

    function convertToDatabaseFormat(isoDateString) {

		const date = new Date(isoDateString);

		date.setHours(date.getHours() + 7); 

		const year = date.getUTCFullYear();

		const month = String(date.getUTCMonth() + 1).padStart(2, '0');

		const day = String(date.getUTCDate()).padStart(2, '0');

		const hours = String(date.getUTCHours()).padStart(2, '0');

		const minutes = String(date.getUTCMinutes()).padStart(2, '0');

		const seconds = String(date.getUTCSeconds()).padStart(2, '0');

		return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

	}


    HT.switchery = () => {
        $('.js-switch').each(function(){
            // let _this = $(this)
            var switchery = new Switchery(this, { color: '#1AB394', size: 'small'});
        })
    }

    HT.select2 = () => {
        if($('.setupSelect2').length){
            $('.setupSelect2').select2();
        }
        
    }

    HT.changeStatus = () => {
        $(document).on('change', '.status', function(e){

            let _this = $(this)
            let option = {
                'value' : _this.val(),
                'modelId' : _this.attr('data-modelId'),
                'model' : _this.attr('data-model'),
                'field' : _this.attr('data-field'),
                '_token' : _token
            }

            $.ajax({
                url: 'ajax/dashboard/changeStatus', 
                type: 'POST', 
                data: option,
                dataType: 'json', 
                success: function(res) {
                    let inputValue = ((option.value == 1)?2:1)
                    if(res.flag == true){
                        _this.val(inputValue)
                    }
                  
                },
                error: function(jqXHR, textStatus, errorThrown) {
                  
                  console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
                }
            });

            e.preventDefault()
        })
    }

    HT.changeStatusAll = () => {
        if($('.changeStatusAll').length){
            $(document).on('click', '.changeStatusAll', function(e){
                let _this = $(this)
                let id = []
                $('.checkBoxItem').each(function(){
                    let checkBox = $(this)
                    if(checkBox.prop('checked')){
                        id.push(checkBox.val())
                    }
                })

                let option = {
                    'value' : _this.attr('data-value'),
                    'model' : _this.attr('data-model'),
                    'field' : _this.attr('data-field'),
                    'id'    : id,
                    '_token' : _token
                }

                $.ajax({
                    url: 'ajax/dashboard/changeStatusAll', 
                    type: 'POST', 
                    data: option,
                    dataType: 'json', 
                    success: function(res) {
                        if(res.flag == true){
                            let cssActive1 = 'background-color: rgb(26, 179, 148); border-color: rgb(26, 179, 148); box-shadow: rgb(26, 179, 148) 0px 0px 0px 16px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;';
                            let cssActive2 = 'left: 13px; background-color: rgb(255, 255, 255); transition: background-color 0.4s ease 0s, left 0.2s ease 0s;';
                            let cssUnActive = 'background-color: rgb(255, 255, 255); border-color: rgb(223, 223, 223); box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s;'
                            let cssUnActive2 = 'left: 0px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s;'

                            for(let i = 0; i < id.length; i++){
                                if(option.value == 2){
                                    $('.js-switch-'+id[i]).find('span.switchery').attr('style', cssActive1).find('small').attr('style', cssActive2)
                                }else if(option.value == 1){
                                    $('.js-switch-'+id[i]).find('span.switchery').attr('style', cssUnActive).find('small').attr('style', cssUnActive2)
                                }
                            }
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                      
                      console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
                    }
                });

                e.preventDefault()
            })
        }
    }

    HT.checkAll = () => {
        if($('#checkAll').length){
            $(document).on('click', '#checkAll', function(){
                let isChecked = $(this).prop('checked')
                $('.checkBoxItem').prop('checked', isChecked);
                $('.checkBoxItem').each(function(){
                    let _this = $(this)
                    HT.changeBackground(_this)
                })
            })
        }
    }

    HT.checkBoxItem = () => {
        if($('.checkBoxItem').length){
            $(document).on('click', '.checkBoxItem', function(){
                let _this = $(this)
                HT.changeBackground(_this)
                HT.allChecked()
            })
        }
    }

    HT.changeBackground = (object) => {
        let isChecked = object.prop('checked')
        if(isChecked){
            object.closest('tr').addClass('active-bg')
        }else{
            object.closest('tr').removeClass('active-bg')
        }
    }

    HT.allChecked = () => {
        let allChecked = $('.checkBoxItem:checked').length === $('.checkBoxItem').length;
        $('#checkAll').prop('checked', allChecked);
    }

    HT.int = () => {
        $(document).on('change keyup blur', '.int', function(){
            let _this = $(this)
            let value = _this.val()
            if(value === ''){
                $(this).val('0')
            }
            value = value.replace(/\./gi, "")
            _this.val(HT.addCommas(value))
            if(isNaN(value)){
                _this.val('0')
            }
        })

        $(document).on('keydown', '.int', function(e){
            let _this = $(this)
            let data = _this.val()
            if(data == 0){
                let unicode = e.keyCode || e.which;
                if(unicode != 190){
                    _this.val('')
                }
            }
        })
    }

    HT.addCommas = (nStr) => { 
        nStr = String(nStr);
        nStr = nStr.replace(/\./gi, "");
        let str ='';
        for (let i = nStr.length; i > 0; i -= 3){
            let a = ( (i-3) < 0 ) ? 0 : (i-3);
            str= nStr.slice(a,i) + '.' + str;
        }
        str= str.slice(0,str.length-1);
        return str;
    }

    HT.setupDatepicker = () => {
        if($('.datepicker').length){
            $('.datepicker').datetimepicker({
                timepicker:true,
                format:'d/m/Y H:i',
                minDate:new Date(),
            });
        }
        
    }


    HT.setupDateRangePicker = () => {
        if($('.rangepicker').length > 0){
            $('.rangepicker').daterangepicker({
                timePicker: true,
                locale: {
                    format: 'dd-mm-yy'
                }
            })
        }
    }
    
    HT.updatePatientOfClinic = () => {

        $(document).ready(function(){

            let lastCheckTime = convertToDatabaseFormat(new Date().toISOString());

            let clinic_id = $('input[name="clinic_id"]').val()

            function updatePatient() {

                $.ajax({

                    url: '/ajax/consultation/getPatient',

                    method: 'GET',

                    data: { last_check_time: lastCheckTime , clinic_id : clinic_id },

                    success: function(res) {

                        if (res.patients.length > 0) {

                            lastCheckTime = convertToDatabaseFormat(new Date().toISOString());

                            HT.appendPatients(res.patients)
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching patients:', textStatus, errorThrown);
                    },
                });
            }
            setInterval(updatePatient, 10000);
        })
    }

    HT.appendPatients = (data) => {

        const $patientList = $('.patient-clinic'); 

        let currentStt = $patientList.find('tr').length;
        
        let newPatientsHtml = '';

        data.forEach(patient => {

            currentStt += 1;

            newPatientsHtml += `
                <tr>
                    <td>
                        <input type="checkbox" value="" class="input-checkbox checkBoxItem">
                    </td>
                    <td class="text-center">
                        ${currentStt}
                    </td>
                    <td>
                        <p>${patient.patient_name} - ${patient.patient_birthday} tuổi</p>
                        <p>Mã bệnh nhân : ${patient.patient_code}</p>
                        <p>SĐT bệnh nhân : ${patient.patient_phone}</p>
                    </td>
                    <td>
                        ${patient.patient_gender}
                    </td>
                    <td>
                        ${patient.symptoms}
                    </td>
                    <td class="text-center"> 
                        <a href="" class="btn btn-success" ><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
            `;
        });

        $patientList.append(newPatientsHtml);
    }

    HT.searchExpense = () => {
        $(document).on('keyup', '.search-model', function(e){
            e.preventDefault()
            let _this = $(this)
            let keyword = _this.val()
            let option = {
                keyword : keyword
            }
            HT.sendAjax(option)
        })
    }

    HT.sendAjax = (option) => {
        clearTimeout(typingTimer);
            typingTimer = setTimeout(function(){
                $.ajax({
                    url: 'ajax/consultation/findExpense', 
                    type: 'GET', 
                    data: option,
                    dataType: 'json', 
                    success: function(res) {
                        let html = HT.renderSearchResult(res)
                        if(html.length){
                            $('.ajax-search-result').html(html).show()
                        }else{
                            $('.ajax-search-result').html(html).hide()
                        }
                    },
                    beforeSend: function() {
                        $('.ajax-search-result').html('').hide()
                    },
                });
               
        }, doneTyingInterval)
    }

    HT.renderSearchResult = (data) => {
        let html = ''
        if(data.length){
            for(let i = 0; i < data.length; i++){

                let flag = ($('#model-'+data[i].id).length) ? 1 : 0;

                let setChecked = ($('#model-'+data[i].id).length) ? HT.setChecked() : '';

                let price = HT.addCommas(data[i].price);


                html += `<button 
                            class="ajax-search-item" 
                            data-flag="${flag}" 
                            data-name="${data[i].name}" 
                            data-id="${data[i].id}"
                            data-price="${price}"
                        >
                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                    <div>${data[i].name}</div>
                    <div class="wr">
                        <div class="price"> ${price} đ</div>
                        <div class="auto-icon">
                            ${setChecked}
                        </div>
                    <div>
                </div>
            </button>`
            }
        }
        return html
    }

    HT.setChecked = () => {
        return '<svg class="svg-next-icon button-selected-combobox svg-next-icon-size-12" width="12" height="12"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 26"><path d="m.3,14c-0.2-0.2-0.3-0.5-0.3-0.7s0.1-0.5 0.3-0.7l1.4-1.4c0.4-0.4 1-0.4 1.4,0l.1,.1 5.5,5.9c0.2,0.2 0.5,0.2 0.7,0l13.4-13.9h0.1v-8.88178e-16c0.4-0.4 1-0.4 1.4,0l1.4,1.4c0.4,0.4 0.4,1 0,1.4l0,0-16,16.6c-0.2,0.2-0.4,0.3-0.7,0.3-0.3,0-0.5-0.1-0.7-0.3l-7.8-8.4-.2-.3z"></path></svg></svg>'
    }

    HT.addModel = () => {
        $(document).on('click', '.ajax-search-item' , function(e){
            e.preventDefault()
            let _this = $(this)
            let data = _this.data()
            let html = HT.modelTemplate(data)
            let flag = _this.attr('data-flag')
            if(flag == 0){
                _this.find('.auto-icon').html(HT.setChecked())
                _this.attr('data-flag', 1)
                $('.search-model-result').append(HT.modelTemplate(data))
            }else{
                $('#model-'+data.id).remove()
                _this.find('.auto-icon').html('')
                _this.attr('data-flag', 0)
            }
        })
    }

    HT.modelTemplate = (data) => {
        let price = HT.addCommas(data.price);
        let html = `<div class="search-result-item" id="model-${data.id}" data-modelid="${data.id}">
            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                <div class="uk-flex uk-flex-middle">
                    <span class="name">${data.name}</span>
                    <button class="btn-pr ml10">+</button>
                    <div class="hidden">
                        <input type="text" name="expense_name" value="${data.name}">
                        <input type="text" name="expense_price" value="${price}">
                    </div>
                </div>
                <div class="deleted uk-flex">
                    <div class="price"> ${price} đ</div>
                    <svg class="svg-next-icon svg-next-icon-size-12" width="12" height="12">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                            <path d="M18.263 16l10.07-10.07c.625-.625.625-1.636 0-2.26s-1.638-.627-2.263 0L16 13.737 5.933 3.667c-.626-.624-1.637-.624-2.262 0s-.624 1.64 0 2.264L13.74 16 3.67 26.07c-.626.625-.626 1.636 0 2.26.312.313.722.47 1.13.47s.82-.157 1.132-.47l10.07-10.068 10.068 10.07c.312.31.722.468 1.13.468s.82-.157 1.132-.47c.626-.625.626-1.636 0-2.26L18.262 16z">
                            </path>
                        </svg>
                    </svg>
                </div>
            </div>
        </div>`
        return html
    }

    HT.unfocusSearchBox = () => {
        $(document).on('click', 'html', function(e){
            if(!$(e.target).hasClass('search-model-result') && !$(e.target).hasClass('search-model')){
                $('.ajax-search-result').html('')
            }
        })

        $(document).on('click', '.ajax-search-result', function(e){
            e.stopPropagation();
        })
    }

    HT.removeModel = () => {
        $(document).on('click', '.deleted', function(){
            let _this = $(this)
            _this.parents('.search-result-item').remove()
        })
    }

    HT.searchProduct = () => {
        $(document).on('keyup', '.search-product', function(e){
            e.preventDefault()
            let _this = $(this)
            let keyword = _this.val()
            let option = {
                keyword : keyword
            }
            HT.sendProduct(option)
        })
    }
 
    HT.sendProduct = (option) => {
        clearTimeout(typingTimer);
            typingTimer = setTimeout(function(){
                $.ajax({
                    url: 'ajax/consultation/findProduct', 
                    type: 'GET', 
                    data: option,
                    dataType: 'json', 
                    success: function(res) {
                        if(res){
                            let html = HT.renderSearchProduct(res)
                            if(html.length){
                                $('.ajax-search-product').html(html).show()
                            }else{
                                $('.ajax-search-product').html(html).hide()
                            }
                        }
                    },
                    beforeSend: function() {
                        
                    },
                });
               
        }, doneTyingInterval)
    }

    HT.renderSearchProduct = (data) => {
        let html = ''
        if(data.length){
            for(let i = 0; i < data.length; i++){

                let flag = ($('#model-'+data[i].id).length) ? 1 : 0;

                let setChecked = ($('#model-'+data[i].id).length) ? HT.setChecked() : '';

                let price = HT.addCommas(data[i].price);


                html += `<button 
                            class="ajax-product" 
                            data-flag="${flag}" 
                            data-name="${data[i].name}" 
                            data-id="${data[i].id}"
                            data-price="${price}"
                        >
                <div class="uk-flex uk-flex-middle uk-flex-space-between">
                    <div>${data[i].name}</div>
                    <div class="wr">
                        <div class="price"> ${price} đ</div>
                        <div class="auto-icon">
                            ${setChecked}
                        </div>
                    <div>
                </div>
            </button>`
            }
        }
        return html
    }

    HT.addProduct = () => {
        $(document).on('click', '.ajax-product' , function(e){
            e.preventDefault()
            let _this = $(this)
            let data = _this.data()
            let html = HT.modelTemplate(data)
            let flag = _this.attr('data-flag')
            if(flag == 0){
                _this.find('.auto-icon').html(HT.setChecked())
                _this.attr('data-flag', 1)
                $('.search-model-product').append(HT.templateProduct(data))

            }else{
                $('#model-'+data.id).remove()
                _this.find('.auto-icon').html('')
                _this.attr('data-flag', 0)
            }
        })
    }

    HT.templateProduct = (data) => {
        let price = HT.addCommas(data.price);
        let html = `<div class="search-result-product" id="model-${data.id}" data-modelid="${data.id}" data-name="${data.name}" data-price="${price}">
            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                <div class="uk-flex uk-flex-middle">
                    <span class="name">${data.name}</span>
                    <div class="hidden">
                        <input type="text" name="expense_name" value="${data.name}">
                        <input type="text" name="expense_price" value="${price}">
                    </div>
                </div>
                <div class="deleted uk-flex">
                    <div class="price"> ${price} đ</div>
                    <svg class="svg-next-icon svg-next-icon-size-12" width="12" height="12">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                            <path d="M18.263 16l10.07-10.07c.625-.625.625-1.636 0-2.26s-1.638-.627-2.263 0L16 13.737 5.933 3.667c-.626-.624-1.637-.624-2.262 0s-.624 1.64 0 2.264L13.74 16 3.67 26.07c-.626.625-.626 1.636 0 2.26.312.313.722.47 1.13.47s.82-.157 1.132-.47l10.07-10.068 10.068 10.07c.312.31.722.468 1.13.468s.82-.157 1.132-.47c.626-.625.626-1.636 0-2.26L18.262 16z">
                            </path>
                        </svg>
                    </svg>
                </div>
            </div>
        </div>`
        return html
    }

    HT.unfocusSearchProduct = () => {
        $(document).on('click', 'html', function(e){
            if(!$(e.target).hasClass('search-model-product') && !$(e.target).hasClass('search-product')){
                $('.ajax-search-product').html('')
            }
        })

        $(document).on('click', '.ajax-search-product', function(e){
            e.stopPropagation();
        })
    }

    HT.removeProduct = () => {
        $(document).on('click', '.search-model-product .deleted', function(){
            let _this = $(this)
            _this.parents('.search-result-product').remove()
        })
    }

    HT.addCommas = (nStr) => { 
        nStr = String(nStr);
        nStr = nStr.replace(/\./gi, "");
        let str ='';
        for (let i = nStr.length; i > 0; i -= 3){
            let a = ( (i-3) < 0 ) ? 0 : (i-3);
            str= nStr.slice(a,i) + '.' + str;
        }
        str= str.slice(0,str.length-1);
        return str;
    }

    HT.btnPre = () => {
        $(document).on('click','.btn-pr', function(e){
            e.preventDefault()
            let _this = $(this)
            let expense_name  = _this.closest('.search-result-item').find('input[name="expense_name"]').val()
            let expense_price  = _this.closest('.search-result-item').find('input[name="expense_price"]').val()
            let patient_id = $('input[name="patient_id"]').val()
            $.ajax({
                url: 'ajax/consultation/createService', 
                type: 'GET', 
                data: {
                    expense_name : expense_name, expense_price : expense_price , patient_id : patient_id
                },
                dataType: 'json', 
                success: function(res) {
                    if(res){
                        HT.printService(res);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error fetching :', textStatus, errorThrown);
                },
            });
        })
    }

    HT.printService = (data) => {
        console.log(data)
        const iframe = document.createElement('iframe');
        iframe.style.position = 'absolute';
        iframe.style.width = '0px';
        iframe.style.height = '0px';
        iframe.style.border = 'none';
        document.body.appendChild(iframe);
        const iframeDocument = iframe.contentWindow.document;
        iframeDocument.open();
        iframeDocument.write(`
            <html>
                <head>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            color: #333;
                            padding: 20px;
                        }

                        h2, h3 {
                            margin: 0;
                            padding: 5px 0;
                        }

                        h2 {
                            font-size: 24px;
                            font-weight: bold;
                            color: #444;
                            margin-bottom: 20px;
                            text-align: center;
                        }

                        h3 {
                            text-align: left;
                            font-size: 15px;
                            color: #007BFF;
                            font-weight: bold;
                        }

                        .info-table {
                            width: 100%;
                            border-collapse: collapse;
                            margin: 10px 0;
                        }

                        .info-table th , .info-table td {
                            text-align: left;
                            padding: 8px;
                            border-bottom: 1px solid #ddd;
                        }

                        .info-table th {
                            width: 30%;
                        }

                        .info-table p span:not(:last-child){
                            margin-bottom: 30px;
                            display: block;
                        }

                        .info-table td {
                            color: #333;
                            line-height: 1.6;
                        }

                        .section {
                            margin-bottom: 10px;
                        }

                        .note td {
                            padding: 30px 8px;
                        }

                        .info-table p span:not(:last-child){
                            margin-bottom: 30px;
                            display: block;
                        }

                        .info-table tr:last-child td, .info-table tr:last-child th {
                            border-bottom: 0;
                        }

                        .uk-flex{
                            display: flex;
                        }

                        .table {
                            width: 100%;
                            max-width: 100%;
                            margin-bottom: 20px;
                            border-right: 1px solid #DDDDDD;
                        }


                        .table > thead > tr > th {
                            border: 1px solid #DDDDDD;
                            border-right:0;
                            vertical-align: middle;
                            padding: 8px;
                        }
                        .table > tbody > tr > td{
                            border: 1px solid #DDDDDD;
                            border-right:0;
                            border-top:0;
                            line-height: 1.42857;
                            padding: 8px;
                            vertical-align: middle;
                            justify-content:center;
                        }

                        th {
                            text-align: left;
                        }
                            
                        .mb20{ 
                            margin-bottom:20px;
                        }

                        p{
                            margin-top:0;
                            margin-bottom:0;
                        }

                        .pr20{
                            padding-right:20px;
                        }

                        /* Hide print button when printing */
                        @media print {
                            .print-button {
                                display: none;
                            }
                        }
                    </style>
                </head>
                <body>
                    <h2>Phiếu Chỉ Định Dịch vụ</h2>
                    <div class="section">
                        <h3>I.Thông Tin</h3>
                        <table class="info-table">
                            <tbody><tr>
                                <th>Họ và tên</th>
                                <td>${data.patient_name}</td>
                            </tr>
                            <tr>
                                <th>Tuổi</th>
                                <td>${data.patient_birthday}</td>
                            </tr>
                            <tr>
                                <th>Giới tính</th>
                                <td>${data.patient_gender}</td>
                            </tr>
                            <tr>
                                <th>Địa chỉ</th>
                                <td>${data.patient_address}</td>
                            </tr>
                            <tr>
                                <th>Nơi chỉ định</th>
                                <td>${data.area}</td>
                            </tr>
                        </tbody></table>
                    </div>
                    <div class="section">
                        <h3 class="mb20">II.Dịch vụ</h3>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Yêu cầu thực hiện dịch vụ</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>${data.expense_name}</td>
                                    <td>${data.expense_price}</td>
                                    <td>${data.expense_price}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>    
                    <div class="section" style="text-align: right; margin-top: 30px;">
                        <h3 class="pr20" style="text-align: right;">Bác sĩ chỉ định</h3>
                        <div style="width: 300px; margin-left: auto;">
                            <p style="text-align: right;">(Ký và ghi rõ họ tên)</p>
                        </div>
                    </div>
                </body>
            </html>
        `);
        iframeDocument.close();
        iframe.contentWindow.focus();
        iframe.contentWindow.print();
        document.body.removeChild(iframe);
    }
    
    HT.btnPrintBill = () => {
        $(document).on('click','.btn-print', function(e){

            e.preventDefault()

            let patient_id = $('input[name="patient_id"]').val() 

            let user_id = $('input[name="user_id"]').val()

            const productData = {};

            let totalPrice = 0;

            $('.search-result-product').each(function(index) {

                const id = $(this).data('modelid');
                
                const name = $(this).data('name');

                const priceText = $(this).data('price');

                const price = parseFloat(priceText.replace(/\./g, ''));

                productData[index] = { [`id`]: id,  [`name`]: name , [`price`]: priceText  }; 

                totalPrice += price;
                
            });

            $.ajax({
                url: 'ajax/consultation/createBill', 
                type: 'GET', 
                data: {
                    productData : productData , patient_id : patient_id , user_id : user_id , totalPrice : totalPrice
                },
                dataType: 'json', 
                success: function(res) {
                    if(res){
                        HT.btnBill(res)
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error fetching :', textStatus, errorThrown);
                },
            });


        })
    }

    HT.btnBill = (data) => {
        const total_price =  HT.addCommas(data.total_price)
        const iframe = document.createElement('iframe');
        iframe.style.position = 'absolute';
        iframe.style.width = '0px';
        iframe.style.height = '0px';
        iframe.style.border = 'none';
        document.body.appendChild(iframe);
        const iframeDocument = iframe.contentWindow.document;
        iframeDocument.open();
        iframeDocument.write(`
            <html>
                <head>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            color: #333;
                            padding: 20px;
                        }

                        h2, h3 {
                            margin: 0;
                            padding: 5px 0;
                        }

                        h2 {
                            font-size: 24px;
                            font-weight: bold;
                            color: #444;
                            margin-bottom: 20px;
                            text-align: center;
                        }

                        h3 {
                            text-align: left;
                            font-size: 15px;
                            color: #007BFF;
                            font-weight: bold;
                        }

                        .info-table {
                            width: 100%;
                            border-collapse: collapse;
                            margin: 10px 0;
                        }

                        .info-table th , .info-table td {
                            text-align: left;
                            padding: 8px;
                            border-bottom: 1px solid #ddd;
                        }

                        .info-table th {
                            width: 30%;
                        }

                        .info-table p span:not(:last-child){
                            margin-bottom: 30px;
                            display: block;
                        }

                        .info-table td {
                            color: #333;
                            line-height: 1.6;
                        }

                        .section {
                            margin-bottom: 10px;
                        }

                        .note td {
                            padding: 30px 8px;
                        }

                        .info-table p span:not(:last-child){
                            margin-bottom: 30px;
                            display: block;
                        }

                        .info-table tr:last-child td, .info-table tr:last-child th {
                            border-bottom: 0;
                        }

                        .uk-flex{
                            display: flex;
                        }

                        .table {
                            width: 100%;
                            max-width: 100%;
                            margin-bottom: 20px;
                            border-right: 1px solid #DDDDDD;
                        }


                        .table > thead > tr > th {
                            border: 1px solid #DDDDDD;
                            border-right:0;
                            vertical-align: middle;
                            padding: 8px;
                        }
                        .table > tbody > tr > td{
                            border: 1px solid #DDDDDD;
                            border-right:0;
                            border-top:0;
                            line-height: 1.42857;
                            padding: 8px;
                            vertical-align: middle;
                            justify-content:center;
                        }

                        th {
                            text-align: left;
                        }
                            
                        .mb20{ 
                            margin-bottom:20px;
                        }

                        p{
                            margin-top:0;
                            margin-bottom:0;
                        }

                        .pr20{
                            padding-right:20px;
                        }

                        /* Hide print button when printing */
                        @media print {
                            .print-button {
                                display: none;
                            }
                        }
                    </style>
                </head>
                <body>
                    <h2>Đơn thuốc</h2>
                    <div class="section">
                        <table class="info-table">
                            <tbody><tr>
                                <th>Họ và tên</th>
                                <td>${data.patient_name}</td>
                            </tr>
                            <tr>
                                <th>Tuổi</th>
                                <td>${data.patient_birthday}</td>
                            </tr>
                            <tr>
                                <th>Giới tính</th>
                                <td>${data.patient_gender}</td>
                            </tr>
                            <tr>
                                <th>Địa chỉ</th>
                                <td>${data.patient_address}</td>
                            </tr>
                            <tr>
                                <th>Số điện thoại</th>
                                <td>${data.patient_phone}</td>
                            </tr>
                            <tr>
                                <th>Chẩn đoán</th>
                                <td>...................................................................................................................</td>
                            </tr>
                        </tbody></table>
                    </div>
                    <div class="section">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên thuốc</th>
                                    <th>Đơn giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${data.payload.map((product, index) => `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td style="width:250px">${product.name}</td>
                                        <td>${product.price}</td>
                                        <td>1</td>
                                        <td>${product.price}</td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                        <h3 class="pr20" style="text-align: right;">Tổng tiền : ${total_price}đ</h3>
                        <h3 class="pr20" style="text-align: left;">Lời dặn :</h3>
                    </div>    
                    <div class="section" style="text-align: right; margin-top: 30px;">
                        <h3 class="" style="text-align: right;">${data.create}</h3>
                        <h3 class="pr20" style="text-align: right;">Bác sĩ chỉ định</h3>
                        <div style="width: 300px; margin-left: auto;">
                            <p style="text-align: right;">(Ký và ghi rõ họ tên)</p>
                        </div>
                    </div>
                </body>
            </html>
        `);
        iframeDocument.close();
        iframe.contentWindow.focus();
        iframe.contentWindow.print();
        document.body.removeChild(iframe);
    }
    


    
	$(document).ready(function(){
        HT.btnPrintBill()
        HT.removeProduct()
        HT.unfocusSearchProduct()
        HT.addProduct()
        HT.searchProduct()
        HT.btnPre()
        HT.removeModel()
        HT.unfocusSearchBox()
        HT.addModel()
        HT.searchExpense()
        HT.updatePatientOfClinic()
        HT.openNewWindow()
        HT.switchery()
        HT.select2()
        HT.changeStatus()
        HT.checkAll()
        HT.checkBoxItem()
        HT.allChecked()
        HT.changeStatusAll()
        HT.int()
        HT.setupDatepicker()
        HT.setupDateRangePicker()
	});

})(jQuery);
