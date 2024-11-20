(function($) {
	"use strict";
	var HT = {}; 
    var _token = $('meta[name="csrf-token"]').attr('content');


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

    HT.pushPatient = () => {

        $(document).ready(function(){

            let lastCheckTime = convertToDatabaseFormat(new Date().toISOString());

            function fetchDataPatient() {

                $.ajax({

                    url: '/ajax/reception/getPatient',

                    method: 'GET',

                    data: { last_check_time: lastCheckTime },

                    success: function(res) {

                        if (res.patients.length > 0) {

                            lastCheckTime = convertToDatabaseFormat(new Date().toISOString());

                            HT.updatePatients(res.patients);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching patients:', textStatus, errorThrown);
                    },
                });
            }
            setInterval(fetchDataPatient, 10000);
        })
    }

    
    HT.updatePatients = (data) => {

        const $patientList = $('.patient-list'); 
        
        let newPatientsHtml = '';

        data.forEach(patient => {

            const editUrl = `${window.location.origin}/reception/patient/${patient.id}/visit`;

            newPatientsHtml += `
                <tr>
                    <td>
                        <input type="checkbox" value="${patient.id}" class="input-checkbox checkBoxItem">
                    </td>
                    <td>
                        <p>${patient.name} - ${patient.birthday} tuổi</p>
                        <p>Mã bệnh nhân : ${patient.code}</p>
                        <p>SĐT bệnh nhân : ${patient.patient_phone}</p>
                    </td>
                    <td>
                        ${patient.gender}
                    </td>
                    <td class="text-center dc">
                        ${patient.cid}
                    </td>
                    <th>
                        ${patient.province_name}
                    </th>
                    <td class="text-center"> 
                        <a href="${editUrl}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    </td>
                </tr>
            `;
        });

        $patientList.prepend(newPatientsHtml);

    }
    

    HT.showClinic = () => {
        $(document).on('change','.sl-department', function(){

            let _this = $(this)

            let department_id = _this.val()

            if(department_id != 0){

                $.ajax({

                    url: '/ajax/clinic/getClinic',

                    method: 'GET',

                    data: { department_id: department_id },

                    success: function(res) {

                        if(res.clinics.length > 0){

                            HT.appendListClinic(res.clinics)

                        }else{

                            $('.list-clinic .wrapper').remove();

                        }

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching :', textStatus, errorThrown);
                    },
                });
            }else{

                $('.list-clinic .wrapper').remove();

            }
        })
    }

    HT.appendListClinic = (data) => {

        const $listClinic = $('.list-clinic'); 
        
        let newClinicHtml = '';

        data.forEach(clinic => {

            newClinicHtml += `
                <div class="wrapper">
                    <div class="col-lg-6">
                        <div class="wizard-form-checkbox">
                            <input type="hidden" name="user_id" value="${clinic.user_id}">
                            <input id="${clinic.id}" name="clinic_id" type="checkbox" value="${clinic.id}" >
                            <label data-id="${clinic.id}" for="${clinic.id}" class="txt">
                                ${clinic.code} - <span class="text-danger">${clinic.name}</span> - Đang chờ : <span class="text-danger">${clinic.patient_count}</span>
                            </label>
                        </div>
                    </div>
                </div>

            `;
        });

        $listClinic.html(newClinicHtml);

    }

    HT.createVisit = () => {
        $(document).on('click', '.btn-visit', function(e){

            e.preventDefault()

            let _this = $(this)

            let modal = _this.closest('.modal')

            let symptoms = modal.find('textarea').val()

            let patient_id = modal.find('input[name="patient_id"]').val()

            let department_id = modal.find('select[name="department_id"]').val()

            let clinic_id = modal.find('input[name="clinic_id"]:checked').val()

            let user_id = modal.find('input[name="user_id"]').val()

            if(department_id != 0 && clinic_id != 0){

                $.ajax({

                    url: '/ajax/visit/createVisit',

                    method: 'POST',

                    data: {  
                        _token : _token , 
                        symptoms: symptoms , 
                        patient_id: patient_id , 
                        department_id : department_id ,  
                        clinic_id : clinic_id ,  
                        user_id : user_id 
                    },

                    success: function(res) {

                        if(res.status == 200){
                            HT.appendVisit(res.visit)
                            HT.appendProblem(res.visit)
                            modal.find('textarea').val('')
                            modal.find('select[name="department_id"]').val(0)
                            modal.find('.list-clinic .wrapper').remove()
                        }

                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching :', textStatus, errorThrown);
                    },
                });
            }
        })
    }

    HT.appendProblem = (data) => {

        const $problem = $('.list-problem'); 
        
        let newProblemHtml = '';

        data.forEach(info => {

            newProblemHtml += `
                
                <div class="visit-item" style="margin-bottom:10px ; border-left : 3px solid ${info.status_code}" data-visit="${info.id}" data-status="${info.status_v}">
                    <h2 class="heading-1">
                        Bệnh nhân : ${info.symptoms} - ${info.created_at} - (${info.clinic_code}) ${info.clinic_name} - Khoa : ${info.department_name}
                    </h2>
                </div>

            `;
        });

        $problem.append(newProblemHtml);

    }


    HT.appendVisit = (data) => {

        const $visit = $('.problem .visit'); 
        
        let newVisitHtml = '';

        data.forEach(info => {

            newVisitHtml += `
                <div class="form" id="visitInfo">
                    <h2>Phiếu Khám Bệnh</h2>
                    <div class="section">
                        <h3>Thông Tin Chung</h3>
                        <table class="info-table">
                            <tr>
                                <th>Trạng thái phiếu khám</th>
                                <td>${info.status}</td>
                            </tr>
                            <tr>
                                <th>Thời gian vào viện</th>
                                <td>${info.created_at}</td>
                            </tr>
                        </table>
                    </div>
                
                    <div class="section">
                        <h3>Thông Tin Bệnh Nhân</h3>
                        <table class="info-table">
                            <tr>
                                <th>Họ và tên</th>
                                <td>${info.patient_name}</td>
                            </tr>
                            <tr>
                                <th>Ngày sinh</th>
                                <td>${info.patient_birthday}</td>
                            </tr>
                            <tr>
                                <th>Giới tính</th>
                                <td>${info.patient_gender}</td>
                            </tr>
                            <tr>
                                <th>Địa chỉ</th>
                                <td>${info.patient_address}</td>
                            </tr>
                            <tr>
                                <th>Liên hệ</th>
                                <td>${info.patient_phone}</td>
                            </tr>
                        </table>
                    </div>
                
                    <div class="section">
                        <h3>Chi Tiết Vấn Đề Sức Khỏe</h3>
                        <table class="info-table">
                            <tr>
                                <th>Triệu chứng chính</th>
                                <td>${info.symptoms}</td>
                            </tr>
                            <tr>
                                <th>Phòng khám</th>
                                <td>${info.clinic_code} - ${info.clinic_name} </td>
                            </tr>
                            <tr>
                                <th>Bác sĩ phụ trách</th>
                                <td>${info.doctor_name}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="section">
                        <h3>Ghi Chú Bổ Sung</h3>
                        <table class="info-table note">
                            <tr >
                                <th>Lưu ý và dặn dò</th>
                                <td>
                                    <p style="font-style: italic; color: #555; line-height: 1.5;">
                                        <span style="display: block; width: 100%; border-bottom: 1px dashed #555;"></span>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <th>Kết luận của bác sĩ</th>
                                <td>
                                    <p style="font-style: italic; color: #555; line-height: 1.5;">
                                        <span style="display: block; width: 100%; border-bottom: 1px dashed #555;"></span>
                                        <span style="display: block; width: 100%; border-bottom: 1px dashed #555;"></span>
                                        <span style="display: block; width: 100%; border-bottom: 1px dashed #555;"></span>
                                        <span style="display: block; width: 100%; border-bottom: 1px dashed #555;"></span>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <button class="print-button">In Phiếu Khám</button>
                </div>

            `;
        });

        $visit.html(newVisitHtml);

    }

    HT.print = () => {
        $(document).on('click', '.print-button', function() {

            const printContents = document.getElementById('visitInfo').innerHTML;
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

                            /* Hide print button when printing */
                            @media print {
                                .print-button {
                                    display: none;
                                }
                            }
                        </style>
                    </head>
                    <body>
                        ${printContents}
                    </body>
                </html>
            `);
            iframeDocument.close();
            iframe.contentWindow.focus();
            iframe.contentWindow.print();
            document.body.removeChild(iframe);
        });
    };

    
    HT.loadVisit = () =>{

        $(document).on('click','.visit-item', function(){

            let _this = $(this)

            let visit_id = _this.data('visit')

            $.ajax({

                url: '/ajax/visit/getVisit',

                method: 'get',

                data: {  
                    visit_id : visit_id 
                },

                success: function(res) {
 
                    if(res.status == 200){
                        HT.appendVisit(res.visit)
                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error fetching :', textStatus, errorThrown);
                },
            });
        })
    }

    HT.checkStatus = () =>{
        $(document).on('click','.btn-status', function(e){

            e.preventDefault()

            let showModal = true;

            $('.visit-item').each(function(){
                if($(this).data('status') == 1){
                    showModal = false;
                    return false;
                }
            })

            if(showModal){
                $('#modalProblem').modal('show');
            }else{
                alert('Bạn cần đóng tất cả phiếu khám cũ để mở phiếu khám mới !')
            }

            
        })
    }
    
   
	$(document).ready(function(){
        HT.checkStatus()
        HT.loadVisit()
        HT.print()
        HT.createVisit()
        HT.showClinic()
        HT.pushPatient()
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
