$(document).ready(function (){
   $('#createAccountBtn').click(function (){
        $('#createAccountPanel').toggleClass('hidden');
   });
   $('#closeFormBtn').click(function () {
       $('#createAccountPanel').addClass('hidden');
   });
   $('#tabs a').click(function (e) {
       var panel = $(this).attr('data-panel');
       $('.tab-panels>div').addClass('hidden');
       $('#tabs li').removeClass('active');
       $(panel).removeClass('hidden');
       $(this).parent('li').addClass('active');
       e.preventDefault();
   });
   $('#toSetup').click(function () {
       openModal($(this).attr('data-value'), 'Main/toSetup');
   });
    $('#toActivated').click(function () {
        openModal($(this).attr('data-value'), 'Main/activate');
    });
    $('#activityBreadcrumb a').click(function (e) {
        var panel = $(this).attr('data-panel');
        $('.activityPanel').addClass('hidden');
        $('#activityBreadcrumb li').removeClass('active');
        $(panel).removeClass('hidden');
        $(this).parent('li').addClass('active');
        e.preventDefault();
    });
});
function openModal($accountId, $action) {
    $('#accountIdHidden').val($accountId);
    $('#toSetupMsg').val('');
    $('#setupModal form').attr('action',$action);
}