 (function($bs) {
     const CLASS_NAME = 'has-child-dropdown-show';
     $bs.Dropdown.prototype.toggle = function(_orginal) {
         return function() {
             document.querySelectorAll('.' + CLASS_NAME).forEach(function(e) {
                 e.classList.remove(CLASS_NAME);
             });
             let dd = this._element.closest('.dropdown').parentNode.closest('.dropdown');
             for (; dd && dd !== document; dd = dd.parentNode.closest('.dropdown')) {
                 dd.classList.add(CLASS_NAME);
             }
             return _orginal.call(this);
         }
     }($bs.Dropdown.prototype.toggle);

     document.querySelectorAll('.dropdown').forEach(function(dd) {
         dd.addEventListener('hide.bs.dropdown', function(e) {
             if (this.classList.contains(CLASS_NAME)) {
                 this.classList.remove(CLASS_NAME);
                 e.preventDefault();
             }
             if (e.clickEvent && e.clickEvent.composedPath().some(el => el.classList && el.classList.contains('dropdown-toggle'))) {
                 e.preventDefault();
             }
             e.stopPropagation(); // do not need pop in multi level mode
         });
     });

     // for hover
     function getDropdown(element) {
         return $bs.Dropdown.getInstance(element) || new $bs.Dropdown(element);
     }

     document.querySelectorAll('.dropdown-hover, .dropdown-hover-all .dropdown').forEach(function(dd) {
         dd.addEventListener('mouseenter', function(e) {
             let toggle = e.target.querySelector(':scope>[data-bs-toggle="dropdown"]');
             if (!toggle.classList.contains('show')) {
                 getDropdown(toggle).toggle();
             }
         });
         dd.addEventListener('mouseleave', function(e) {
             let toggle = e.target.querySelector(':scope>[data-bs-toggle="dropdown"]');
             if (toggle.classList.contains('show')) {
                 getDropdown(toggle).toggle();
             }
         });
     });
 })(bootstrap);
 //]]>
 $(function() {
     $(".tree li:has(ul)")
         .addClass("parent_li")
         .find(" > span")
         .attr("title", "Collapse this branch");

     $(document).on("click", ".tree li.parent_li > span", function(e) {
         var children = $(this).parent("li.parent_li").find(" > ul > li");
         var p = this;
         var icon = $(this).attr("title", "Collapse this branch").find(" > i");

         if (children.is(":visible")) {
             if ($(this).attr('data-model')) {
                 children.remove();
                 let model = $(this).attr('data-model');
                 let target = $(this).attr('data-target');
                 let id = $(this).attr('data-id');
                 if ($(this).attr('data-model')) {
                     $.get('/management/addChildren?model=' + model + '&target=' +
                         target +
                         '&id=' + id,
                         function(res) {
                             $("div.tree_content").html(res)
                         });
                 }
                 if (!$(icon).hasClass("lastchild"))
                     $(icon).addClass("fa-plus").removeClass("fa-minus");
             } else {
                 children.hide("fast");
                 if (!$(icon).hasClass("lastchild"))
                     $(icon).addClass("fa-plus").removeClass("fa-minus");
             }
         } else {
             let model = $(this).attr('data-model');
             let target = $(this).attr('data-target');
             let id = $(this).attr('data-id');

             if (target) {
                 $.get('/management/children?model=' + model + '&target=' + target +
                     '&id=' +
                     id,
                     function(res) {
                         $(res).insertAfter(p)
                         $.get('/management/addChildren?model=' + model +
                             '&target=' +
                             target + '&id=' + id,
                             function(res) {
                                 $("div.tree_content").html(res)
                             })
                     })
                 var children = $(this).parent("li.parent_li").find(" > ul > li");
                 children.show("fast");
                 if (!$(icon).hasClass("lastchild"))
                     $(icon).addClass("fa-minus").removeClass("fa-plus");
             } else {
                 var children = $(this).parent("li.parent_li").find(" > ul > li");

                 children.show("fast");
                 if (!$(icon).hasClass("lastchild"))
                     $(icon).addClass("fa-plus").removeClass("fa-minus");
             }
         }
         e.stopPropagation();
     });
 });