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
    
	$(document).ready(function(){
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
