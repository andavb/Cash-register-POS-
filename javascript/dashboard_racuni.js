
    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0, 10);
    });

    $(document).ready(function() {
        $('#datum1').val(new Date().toDateInputValue());
        $('#datum2').val(new Date().toDateInputValue());
        razpon($('#sel1').val());
    });

    function razpon(v) {

      var danes = new Date();

      var datum1 = new Date(danes);
      var datum2 = new Date(danes);
      var dd1;
      var dd2;
      var mm1;
      var mm2;
      var yy1;
      var yy2;

      if (v == "danes") {
          dd1 = datum1.getDate();
          dd2 = datum2.getDate();
          mm1 = datum1.getMonth() + 1;
          mm2 = datum2.getMonth() + 1;
          yy1 = datum1.getFullYear();
          yy2 = datum2.getFullYear();
      } else if (v == "vceraj") {
          dd1 = datum1.getDate() - 1;
          dd2 = datum2.getDate() - 1;
          mm1 = datum1.getMonth() + 1;
          mm2 = datum2.getMonth() + 1;
          yy1 = datum1.getFullYear();
          yy2 = datum2.getFullYear();
      } else if (v == "ta_teden") {
          var day = datum1.getDay();
          diff = datum1.getDate() - day + (day == 0 ? -6 : 1);
          datum1 = new Date(datum1.setDate(diff));

          dd1 = datum1.getDate();
          dd2 = datum2.getDate();
          mm1 = datum1.getMonth() + 1;
          mm2 = datum2.getMonth() + 1;
          yy1 = datum1.getFullYear();
          yy2 = datum2.getFullYear();
      } else if (v == "ta_mesec") {

          datum1 = new Date(datum1.getFullYear(), datum1.getMonth(), 1);

          dd1 = datum1.getDate();
          dd2 = datum2.getDate();
          mm1 = datum1.getMonth() + 1;
          mm2 = datum2.getMonth() + 1;
          yy1 = datum1.getFullYear();
          yy2 = datum2.getFullYear();
      } else if (v == "to_leto") {

          datum1 = new Date(datum1.getFullYear(), datum1.getMonth(), 1);

          datum1 = new Date(new Date().getFullYear(), 0, 1);

          dd1 = datum1.getDate();
          dd2 = datum2.getDate();
          mm1 = datum1.getMonth() + 1;
          mm2 = datum2.getMonth() + 1;
          yy1 = datum1.getFullYear();
          yy2 = datum2.getFullYear();
      }

      if (dd1 < 10) {
          dd1 = '0' + dd1
      }
      if (dd2 < 10) {
          dd2 = '0' + dd2
      }
      if (mm1 < 10) {
          mm1 = '0' + mm1
      }
      if (mm2 < 10) {
          mm2 = '0' + mm2
      }
      date1 = yy1 + '-' + mm1 + '-' + dd1;
      date2 = yy2 + '-' + mm2 + '-' + dd2;
      ajax(date1, date2);
    }

    function datumFields() {
        datum1 = document.getElementById('datum1').value;
        datum2 = document.getElementById('datum2').value;
        ajax(datum1, datum2);
    }

    function formatDate(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();
        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;
        return [day, month, year].join('-');
    }
    function formatDateAndHours(date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear(),
            hour = d.getHours(),
            minutes = d.getMinutes(),
            seconds = d.getSeconds();
        if (month.length < 2) month = '0' + month;
        if (day.length < 2) day = '0' + day;
        if (hour < 10) hour = '0' + hour; console.log(hour.length);
        if (minutes < 10) minutes = '0' + minutes;
        if (seconds < 10) seconds = '0' + seconds;

        var vrni = [day, month, year].join('-') + " " + [hour, minutes, seconds].join(':');
        return vrni;
    }

    function natisni_obracun() {
      document.getElementById("mainR").style.margin = "0px 0px 0px 0px";
      document.getElementById("natisni").style.visibility = "hidden";
      document.getElementById("sideBar").style.visibility = "hidden";
      document.getElementById("form").style.visibility = "hidden";
      document.getElementById("hide").hidden = false;
      window.print();
      document.getElementById("hide").hidden = true;
      document.getElementById("mainR").style.margin = "0px 0px 0px 250px";
      document.getElementById("natisni").style.visibility = "visible";
      document.getElementById("sideBar").style.visibility = "visible";
      document.getElementById("form").style.visibility = "visible";
    }

    function ajax(date1, date2) {
      var xhr = new XMLHttpRequest();
      xhr.open('GET', 'scripts/output_racun.php?datum1=' + date1 + '&datum2=' + date2, true);
      xhr.send();

      xhr.onreadystatechange = function() {
          var DONE = 4;
          var OK = 200;
          if (xhr.readyState === DONE) {
              if (xhr.status === OK) {
                  var data = JSON.parse(this.responseText);

                  console.log(data);

                  document.getElementById('datum1').value = data[0];
                  document.getElementById('datum2').value = data[1];

                  datum1 = formatDate(data[0]);
                  datum2 = formatDate(data[1]);

                  var tableHeaderRowCount = 1;
                  var table = document.getElementById('tabela');
                  var rowCount = table.rows.length;
                  for (var i = tableHeaderRowCount; i < rowCount; i++) {
                      table.deleteRow(tableHeaderRowCount);
                  }

                  var table = document.getElementById("tabela");


                  for (var i = 2; i < data.length; i++) {

                      var row = table.insertRow(i - 1);

                      var datum = row.insertCell(0);
                      var id = row.insertCell(1);
                      var cena = row.insertCell(2);
                      var miza = row.insertCell(3);
                      var izdal = row.insertCell(4);

                      var d = formatDateAndHours(data[i].time);

                      datum.innerHTML = "<p>" + d + "</p>";
                      id.innerHTML = "<p>" + data[i].ID_order + "</p>";
                      cena.innerHTML = "<p>" + data[i].price_all + " €</p>";
                      miza.innerHTML = "<p>" + data[i].table_ID_table + "</p>";
                      izdal.innerHTML = "<p>" + data[i].firstname + " " + data[i].lastname + "</p>";
                }
            }
          }
        }
     }