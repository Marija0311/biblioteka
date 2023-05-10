$('#dodajForm').submit(function () {
  event.preventDefault();
  console.log("Dodavanje");
  const $form = $(this);
  const $input = $form.find('input, select, button, textarea');

  const serijalizacija = $form.serialize();
  console.log(serijalizacija);

  $input.prop('disabled', true);

  req = $.ajax({
    url: 'handler/dodajKnjigu.php',
    type: 'post',
    data: serijalizacija
  });

  req.done(function (res, textStatus, jqXHR) {
    if (res == "Ok") {
      alert("Knjigu ste uspesno dodali!");
      location.reload(true);
    } else console.log("Knjigu niste dodali! " + res);
  });

  req.fail(function (jqXHR, textStatus, errorThrown) {
    console.error('Sledeca greska se desila: ' + textStatus, errorThrown)
  });
});



$('.btn-danger').click(function () {
  
  console.log("Brisanje");
  const trenutni = $(this).attr('data-id1');  //jQuery fja koja vraca vrednost prosledjenog atributa
  console.log('ID selektovane knjige za brisanje je: ' + trenutni);
  req = $.ajax({
    url: 'handler/obrisiKnjigu.php',
    type: 'post',
    data: { 'id': trenutni }
  });

  req.done(function (res, textStatus, jqXHR) {
    if (res == "Ok") {
      $(this).closest('tr').remove();
      alert('Uspesno ste obrisali knjigu!');
      location.reload(true);
      console.log('Obrisana');
    } else {
      console.log("Knjiga nije obrisana " + res);
      alert("Knjiga nije izbrisana ");

    }
  });

});



$('#btn').click(function () {
  $('#pregled').toggle();
});

$('#btnDodaj').submit(function () {
  $('#myModal').modal('toggle');
  return false;
});

$('#btnIzmeni').submit(function () {
  $('#myModal').modal('toggle');
  return false;
});

$("#writer").change(function(){
  var writerid =  $('#writer').val();
  $('#writerid').val(writerid);
  
});


//Edit
$('.btn-info').click(function () {

  const trenutni = $(this).attr('data-id2');
  console.log(trenutni);
  var title = $(this).closest('tr').children('td[data-target=title]').text();
  console.log(title);
  var god = $(this).closest('tr').children('td[data-target=god]').text();
  
  var published_in = $(this).closest('tr').children('td[data-target=published_in]').text();
  console.log(published_in);
  var writerid = $(this).closest('tr').children('td[data-target=writerid]').text();
  console.log(writerid);
  


  $('#bookid').val(trenutni);
  $('#title').val(title);
  $('#god').val(god);
  document.getElementById('tipOznaceni').value = writerid;
});

//Updates
$('#izmeniForma').submit(function(){
  event.preventDefault();
  console.log("Izmena");
  const $form = $(this);
  const $input = $form.find('input, select, button, textarea');

  const serijalizacija = $form.serialize();
  console.log(serijalizacija);

  $input.prop('disabled', true);

  req = $.ajax({
    url: 'handler/azurirajKnjigu.php',
    type: 'post',
    data: serijalizacija
  });

  req.done(function (res, textStatus, jqXHR) {
    if (res == 'Ok') {
      alert("Knjiga je uspesno azurirana");
      location.reload(true);
    } else console.log("Knjiga nije azurirana " + res);
  });

  req.fail(function (jqXHR, textStatus, errorThrown) {
    console.error('Sledeca greska se desila: ' + textStatus, errorThrown)
  });


});


