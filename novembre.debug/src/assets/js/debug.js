
var novembreInput = {

    opened : null,

    events : function()
    {
        var _this = this;

        $('.module-action--open').click(function(e)
        {
            e.preventDefault();
            _this.openDetails($(this));
        });
    },

    openDetails: function($$)
    {
        var _this = this;
        var module = $$.attr('id');

        $('.module-console').hide();

        if($('#novembre-debug').outerHeight() <= 50)
        {
            $('#'+module+"-console").show();
            $('#novembre-debug').css('height', 300);
        }
        else
        {
            if(module == _this.opened)
            {
                $('#novembre-debug').css('height', 50);
                $('#'+module+"-console").hide();
            }
            else
            {
                $('#'+_this.opened+"-console").hide();   
                $('#'+module+"-console").show();
            }

        }
        _this.opened = module;

    }
};
