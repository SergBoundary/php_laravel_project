    <!-- Footer -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script type="text/javascript">
        var app = new Vue({
            el: '#app',
            data: {
                message: 'Тестовая версия 3.2',
            }
        });
        function autoChangePieceworks(etap) {
            var orderCount = gOrderCount;
            var order, i;
            var symbolType, type;
            var symbolUnit, unit;
            var numericQuantity, quantity;
            var numericPrice, price;
            if(etap == 0) {
                for (order = 0; order < orderCount; order++) {
                    for (i = 1; i < 3; i++) {
                        type = 0;
                        unit = 0;
                        quantity = 0;
                        price = 0;
                        total = 0;
                        symbolType = $('#type_' + i + '_' + order).val().match(/^[A-Za-zА-Яа-я0-9]$/);
                        if(symbolType !== null) {
                            type = symbolType;
                        }
                        symbolUnit = $('#type_' + i + '_' + order).val().match(/^[A-Za-zА-Яа-я0-9]$/);
                        if(symbolUnit !== null) {
                            unit = symbolUnit;
                        }
                        numericQuantity = $('#quantity_' + i + '_' + order).val().match(/^[0-9]+$/);
                        if(numericQuantity !== null) {
                            quantity = parseFloat(numericQuantity);
                        }
                        numericPrice = $('#price_' + i + '_' + order).val().match(/^[0-9]+$/);
                        if(numericPrice !== null) {
                            price = parseFloat(numericPrice);
                        }
                        $('#total_' + i + '_' + order).val(quantity * price);
                    }
                }
            } else if (etap == 1) {
                for (order = 0; order < orderCount; order++) {
                    type = 0;
                    unit = 0;
                    quantity = 0;
                    price = 0;
                    total = 0;
                    symbolType = $('#type_' + order).val().match(/^[A-Za-zА-Яа-я0-9]$/);
                    if(symbolType !== null) {
                        type = symbolType;
                    }
                    symbolUnit = $('#type_' + order).val().match(/^[A-Za-zА-Яа-я0-9]$/);
                    if(symbolUnit !== null) {
                        unit = symbolUnit;
                    }
                    numericQuantity = $('#quantity_' + order).val().match(/^[0-9]+$/);
                    if(numericQuantity !== null) {
                        quantity = parseFloat(numericQuantity);
                    }
                    numericPrice = $('#price_' + order).val().match(/^[0-9]+$/);
                    if(numericPrice !== null) {
                        price = parseFloat(numericPrice);
                    }
                    $('#total_' + order).val(quantity * price);
                }
            }
        }
        function autoChangeBaseTimesheets() {
            var orderCount = gOrderCount;
            var order, i;
            var summHours, summHourly, hourlyDay, pieceworksDay, avgRate;
            var numericHours, numericRate, numericPieceworks, symbolHours, symbolRate;
            for (order = 0; order < orderCount; order++) {
                summHours = 0;
                summHourly = 0;
                numericPieceworks = 0;
                hourlyDay = 0;
                pieceworksDay = 0;
                avgRate = 0;
                for (i = 1; i < 32; i++) {
                    // Обрабатываем символы отметок: отпуск (О), выходной (В), болезнь (Б), прогул (П)
                    symbolHours = $('#hours_day_' + i + '_' + order).val().match(/^[ОВБПовбп]$/);
                    if(symbolHours !== null) {
                        symbolHours = symbolHours.toString();
                        $('#rate_day_' + i + '_' + order).val("");
                    }
                    // Обрабатываем символы отметок: сдельна работа (С)
                    symbolRate = $('#rate_day_' + i + '_' + order).val().match(/^[Сс]$/);
                    // Обрабатываем и суммируем отработанные часы
                    numericHours = $('#hours_day_' + i + '_' + order).val().match(/^[0-9]+$/);
                    if(numericHours !== null) {
                        numericHours = parseFloat(numericHours);
                        if(symbolRate !== null) {
                            pieceworksDay++;
                        } else {
                            summHours = summHours + numericHours;
                        }
                    }
                    // Обрабатываем и посчитываем средневзвешенную дневной ставки
                    numericRate = $('#rate_day_' + i + '_' + order).val().match(/^[0-9]+$/);
                    if(numericRate !== null) {
                        numericRate = parseFloat(numericRate);
                        hourlyDay++;
                        summHourly = summHourly + (numericHours * numericRate);
                    }
                }
                $('#hours_' + order).val(summHours);
                $('#hourly_' + order).val(summHourly);
                avgRate = summHourly/summHours;
                if(Number.isNaN(avgRate) !== true) {
                    $('#rate_' + order).val(avgRate);
                }
                numericPieceworks = $('#piecework_' + order).val().match(/^[0-9]+$/);
                if(numericPieceworks !== null) {
                    numericPieceworks = parseFloat(numericPieceworks);
                }
                $('#total_' + order).val(summHourly + numericPieceworks);
            }
        }
        $(document).ready(function() {
            $('#hours_day_1').click(function() {
                var orderCount = gOrderCount;
                if(orderCount == 0) orderCount = 1;
                var order, i;
                var colValue = $('#hours_day_1').val();
                var colWidth = $('.department-team').css('width');
                colWidth = parseInt(colWidth);
//                alert("Before: " + colWidth);
                if(colValue == "1   ◄") {
                    for (i = 2; i < 11; i++) {
                        $('#hours_day_' + i).hide();
                        for (order = 0; order < orderCount; order++) {
                            $('#hours_day_' + i + '_' + order).hide();
                            $('#rate_day_' + i + '_' + order).hide();
                        }
                    }
                    colWidth = colWidth - 450;
                    $('#hours_day_1').val("1   ►");
                } else if(colValue == "1   ►") {
                    for (i = 2; i < 11; i++) {
                        $('#hours_day_' + i).show();
                        for (order = 0; order < orderCount; order++) {
                            $('#hours_day_' + i + '_' + order).show();
                            $('#rate_day_' + i + '_' + order).show();
                        }
                    }
                    colWidth = colWidth + 450;
                    $('#hours_day_1').val("1   ◄");
                }
//                alert("After: " + colWidth);
                $('.department-team').css('width', colWidth + "px");
            });
            $('#hours_day_11').click(function() {
                var orderCount = gOrderCount;
                if(orderCount == 0) orderCount = 1;
                var order, i;
                var colValue = $('#hours_day_11').val();
                var colWidth = $('.department-team').css('width');
                colWidth = parseInt(colWidth);
                if(colValue == "11 ◄") {
                    for (i = 12; i < 21; i++) {
                        $('#hours_day_' + i).hide();
                        for (order = 0; order < orderCount; order++) {
                            $('#hours_day_' + i + '_' + order).hide();
                            $('#rate_day_' + i + '_' + order).hide();
                        }
                    }
                    colWidth = colWidth - 450;
                    $('#hours_day_11').val("11 ►");
                } else if(colValue == "11 ►") {
                    for (i = 12; i < 21; i++) {
                        $('#hours_day_' + i).show();
                        for (order = 0; order < orderCount; order++) {
                            $('#hours_day_' + i + '_' + order).show();
                            $('#rate_day_' + i + '_' + order).show();
                        }
                    }
                    colWidth = colWidth + 450;
                    $('#hours_day_11').val("11 ◄");
                }
                $('.department-team').css('width', colWidth + "px");
            });
            $('#hours_day_21').click(function() {
                var orderCount = gOrderCount;
                if(orderCount == 0) orderCount = 1;
                var order, i;
                var colValue = $('#hours_day_21').val();
                var colWidth = $('.department-team').css('width');
                colWidth = parseInt(colWidth);
                if(colValue == "21 ◄") {
                    for (i = 22; i < 31; i++) {
                        $('#hours_day_' + i).hide();
                        for (order = 0; order < orderCount; order++) {
                            $('#hours_day_' + i + '_' + order).hide();
                            $('#rate_day_' + i + '_' + order).hide();
                        }
                    }
                    colWidth = colWidth - 450;
                    $('#hours_day_21').val("21 ►");
                } else if(colValue == "21 ►") {
                    for (i = 22; i < 31; i++) {
                        $('#hours_day_' + i).show();
                        for (order = 0; order < orderCount; order++) {
                            $('#hours_day_' + i + '_' + order).show();
                            $('#rate_day_' + i + '_' + order).show();
                        }
                    }
                    colWidth = colWidth + 450;
                    $('#hours_day_21').val("21 ◄");
                }
                $('.department-team').css('width', colWidth + "px");
            });
            $('.auto-base-timesheets').click(function(){
                var id = $(this).attr('id');
                var parse = id.split("_");
                var order = parse[parse.length - 1];
                var numericHours, symbolHours, numericRate, symbolRate;
                var compareHours, compareRate, compareSymbol;
                var i;
                if(order == "auto") {
                    alert('Test Auto: ' + id + ' / ' + order);
                } else {
                    compareHours = "";
                    compareRate = "";
                    order = parseInt(order);
                    for (i = 1; i < 32; i++) {
                        symbolHours = $('#hours_day_' + i + '_' + order).val().match(/^[ОВБП-]$/);
                        numericHours = $('#hours_day_' + i + '_' + order).val().match(/^[0-9]+$/);
                        if(symbolHours !== null) {
                            if(numericHours == "-"){
                                compareHours = "-";
                            } else if(numericHours != "-") {
                                compareHours = symbolHours;
                            }
                        } else if(numericHours !== null) {
                            compareHours = numericHours;
                        }
                        $('#hours_day_' + i + '_' + order).val(compareHours);
                        symbolRate = $('#rate_day_' + i + '_' + order).val().match(/^[С]$/);
                        numericRate = $('#rate_day_' + i + '_' + order).val().match(/^[0-9]+$/);
                        if(compareHours != "-"){
                            if(symbolRate !== null) {
                                compareRate = symbolRate;
                            } else if(numericRate !== null) {
                                compareRate = numericRate;
                            }
                            $('#rate_day_' + i + '_' + order).val(compareRate);
                        } else if(compareHours == "-"){
                            if(symbolRate !== null) {
                                compareRate = symbolRate;
                            } else if(numericRate !== null) {
                                compareRate = numericRate;
                            }
                            $('#rate_day_' + i + '_' + order).val("-");
                        } else if(compareHours == ""){
                            if(symbolRate !== null) {
                                compareRate = symbolRate;
                            } else if(numericRate !== null) {
                                compareRate = numericRate;
                            }
                            $('#rate_day_' + i + '_' + order).val("-");
                        }
                    }
                    autoChangeBaseTimesheets();
                }
            });
            $('.calc-base-timesheets').on('change', function(){
                autoChangeBaseTimesheets();
            });
            $('.calc-pieceworks-create').on('change', function(){
                autoChangePieceworks(0);
            });
            $('.calc-pieceworks-update').on('change', function(){
                autoChangePieceworks(1);
            });
            $('#personal_card_id').on('change', function() {
                var leader = $('#personal_card_id').val();
                var dataString = '{"id":"' + leader + '"}';
                var dt = new Date();
                var cdt= dt.getFullYear() + '-' + (dt.getMonth() +1 ) + '-' + dt.getDate();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/ajax-team-leader/" + leader,
                    data: dataString,
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function(data) {
                        $('#photo_img').attr('src', data['photo_url']);
                        $('#photo_url').val(data['photo_url']);
                        $('#surname').val(data['surname']);
                        $('#first_name').val(data['first_name']);
                        $('#second_name').val(data['second_name']);
                        $('#personal_account').val(data['personal_account']);
                        $('#sex').val(data['sex']);
                        $('#born_date').val(data['born_date']);
                        $('#phone').val(data['phone']);
                        $('#email').val(data['email']);
                        $('#department').val(data['department']);
                        $('#position').val(data['position']);
                        $('#profession').val(data['profession']);
                        $('#profession_code').val(data['profession_code']);
                        $('#title').val('Бригада ' + data['surname']);
                        $('#abbr').val(data['surname']);
                        if ($('#header').text() == "Новая бригада") {
                            $('#start').val(cdt);
                            $('#assignment_date').val(data['assignment_date']);
                        } else if ($('#header').text() == "Новое назначение") {
                            $('#assignment_date').val(cdt);
                        } else if ($('#header').text() == "Новое перемещение") {
                            $('#start').val(cdt);
                        }
                        console.log(data);
                    }
                });
            });
//            $('.user-name').on('change',function() {
//                var name = "";
//                var surname, name;
//                surname = $('#surname').val().match(/^[A-Za-z-]+$/);
//                name = $('#name').val().match(/^[A-Za-z-]+$/);
//                if(surName !== null && firstName !== null) {
//                   $('#name').val($('#surname').val() + " " + $('#name').val() + " " + $('#second_name').val());
//                } else if(surName !== null && name === null) {
//                   $('#name').val($('#surname').val() + " " + $('#name').val());
//                } else if(surName !== null && firstName === null && secondName !== null) {
//                   $('#name').val($('#surname').val() + " " + $('#second_name').val());
//                } else if(surName !== null && firstName === null && secondName === null) {
//                   $('#name').val($('#surname').val());
//                } else if(surName === null && firstName === null && secondName === null) {
//                   $('#name').val("");
//                }
//            });
            
//            $('.lang').click(function(){
//                var id = $(this).attr('id');
//                switch(id) {
//                    case 'lang-pl':
//                    $('#lang-title').text('PL');
//                    break;
//                    case 'lang-en':
//                    $('#lang-title').text('EN');
//                    break;
//                    case 'lang-ru':
//                    $('#lang-title').text('RU');
//                    break;
//                    case 'lang-ua':
//                    $('#lang-title').text('UA');
//                    break;
//                    default:
//                    $('#lang-title').text('PL');
//                }
//                
//            });
        });
    </script>