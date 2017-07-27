    <!-- jQuery -->
    <script src="{{ asset('/vendor/admpanel/assets/templates/admin/js/jquery.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('/vendor/admpanel/assets/templates/admin/js/bootstrap.min.js') }}"></script>
    
    <!-- Morris Charts JavaScript -->
    <script src="{{ asset('/vendor/admpanel/assets/templates/admin/js/plugins/morris/raphael.min.js') }}"></script>
    <script src="{{ asset('/vendor/admpanel/assets/templates/admin/js/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('/vendor/admpanel/assets/templates/admin/js/plugins/morris/morris-data.js') }}"></script>    <!-- jQuery -->
    <script src="{{ asset('/vendor/admpanel/assets/templates/admin/js/jquery.js') }}"></script>

    <!-- tinymce -->
    <script src="{{ asset('/vendor/admpanel/assets/templates/admin/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('/vendor/admpanel/assets/templates/admin/js/tinymce.js') }}"></script>
    
    
    <script type="text/javascript" src="{{ asset('/vendor/admpanel/assets/templates/admin/latest/markitup/jquery.markitup.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/vendor/admpanel/assets/templates/admin/latest/markitup/sets/default/set.js') }}"></script>
    <script src="{{ asset('/vendor/admpanel/assets/templates/admin/js/markitup.js') }}"></script>
    
    
    <script type="text/javascript">             
$(document).ready(function() {
    var treeState = { // объект, который хранит состояния веток
        state: JSON.parse(localStorage.getItem('branchOpened')) || {},
        setOpened: function(element) {
            this.state[this._getKey(element)] = true;
            this._save();
        },
        setClosed: function(element) {
            delete this.state[this._getKey(element)];
            this._save();
        },
        isClosed: function(element) {
            return !this.state[this._getKey(element)];
        },
        _save: function() {
            localStorage.setItem('branchOpened', JSON.stringify(this.state));
        },
        _getKey: function(element) {
            var ixs = [];
            $(element).parentsUntil('withChildren', 'li')
                .each(function(ix, item) {
                    ixs.unshift($(item).index());
                });
            return ixs.join(',');
        }
    };
    $('.withChildren').find('li:has(ul:has(li))').prepend('<div class="drop"></div>');
    $('.withChildren  a').click(function() {
        var branch = $(this).nextAll('ul').first();
        if (branch.css('display') == 'none') {
            branch.slideDown(400);
            $(this).css({'background-position': '-11px 0px'});
            // сохраняем состояние ветви
            treeState.setOpened(branch);
        }
        else {
            branch.slideUp(400);
            $(this).css({'background-position': '0 0'});
            // сохраняем состояние ветви
            treeState.setClosed(branch);
        }
    });

    $('.withChildren ul').each(function(ix, branch) {
        if (treeState.isClosed(branch)) {
            $(branch).slideUp(400)
                .prevAll('ul')
            	.css({'background-position': '0 0'});
        }
    });
});
    </script>
    <!-- Posts --><!-- Settings -->
    @yield('js-bottom')
    

       
    
    
    

