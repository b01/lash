
window.projectVersion = 'master';

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:Whip" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Whip.html">Whip</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:Whip_Lash" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Whip/Lash.html">Lash</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:Whip_Lash_Validators" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="Whip/Lash/Validators.html">Validators</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:Whip_Lash_Validators_Comparison" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Whip/Lash/Validators/Comparison.html">Comparison</a>                    </div>                </li>                            <li data-name="class:Whip_Lash_Validators_File" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Whip/Lash/Validators/File.html">File</a>                    </div>                </li>                            <li data-name="class:Whip_Lash_Validators_FileUpload" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Whip/Lash/Validators/FileUpload.html">FileUpload</a>                    </div>                </li>                            <li data-name="class:Whip_Lash_Validators_Password" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="Whip/Lash/Validators/Password.html">Password</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:Whip_Lash_Validation" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Whip/Lash/Validation.html">Validation</a>                    </div>                </li>                            <li data-name="class:Whip_Lash_Validator" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="Whip/Lash/Validator.html">Validator</a>                    </div>                </li>                </ul></div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": "Whip.html", "name": "Whip", "doc": "Namespace Whip"},{"type": "Namespace", "link": "Whip/Lash.html", "name": "Whip\\Lash", "doc": "Namespace Whip\\Lash"},{"type": "Namespace", "link": "Whip/Lash/Validators.html", "name": "Whip\\Lash\\Validators", "doc": "Namespace Whip\\Lash\\Validators"},
            {"type": "Interface", "fromName": "Whip\\Lash", "fromLink": "Whip/Lash.html", "link": "Whip/Lash/Validator.html", "name": "Whip\\Lash\\Validator", "doc": "&quot;Class Validator&quot;"},
                                                        {"type": "Method", "fromName": "Whip\\Lash\\Validator", "fromLink": "Whip/Lash/Validator.html", "link": "Whip/Lash/Validator.html#method_addCustomValidator", "name": "Whip\\Lash\\Validator::addCustomValidator", "doc": "&quot;Add your own custom validation.&quot;"},
                    {"type": "Method", "fromName": "Whip\\Lash\\Validator", "fromLink": "Whip/Lash/Validator.html", "link": "Whip/Lash/Validator.html#method_addRule", "name": "Whip\\Lash\\Validator::addRule", "doc": "&quot;Add a rule for a named value (ex, a name can be a field in a form post).&quot;"},
                    {"type": "Method", "fromName": "Whip\\Lash\\Validator", "fromLink": "Whip/Lash/Validator.html", "link": "Whip/Lash/Validator.html#method_addRules", "name": "Whip\\Lash\\Validator::addRules", "doc": "&quot;Add multiple rules to validate named values.&quot;"},
                    {"type": "Method", "fromName": "Whip\\Lash\\Validator", "fromLink": "Whip/Lash/Validator.html", "link": "Whip/Lash/Validator.html#method_getErrors", "name": "Whip\\Lash\\Validator::getErrors", "doc": "&quot;Get the errors for fields that failed validation.stringLen&quot;"},
                    {"type": "Method", "fromName": "Whip\\Lash\\Validator", "fromLink": "Whip/Lash/Validator.html", "link": "Whip/Lash/Validator.html#method_validate", "name": "Whip\\Lash\\Validator::validate", "doc": "&quot;&quot;"},
            
            
            {"type": "Class", "fromName": "Whip\\Lash", "fromLink": "Whip/Lash.html", "link": "Whip/Lash/Validation.html", "name": "Whip\\Lash\\Validation", "doc": "&quot;Class Validation&quot;"},
                                                        {"type": "Method", "fromName": "Whip\\Lash\\Validation", "fromLink": "Whip/Lash/Validation.html", "link": "Whip/Lash/Validation.html#method___construct", "name": "Whip\\Lash\\Validation::__construct", "doc": "&quot;Validation constructor&quot;"},
                    {"type": "Method", "fromName": "Whip\\Lash\\Validation", "fromLink": "Whip/Lash/Validation.html", "link": "Whip/Lash/Validation.html#method_addCustomValidator", "name": "Whip\\Lash\\Validation::addCustomValidator", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Whip\\Lash\\Validation", "fromLink": "Whip/Lash/Validation.html", "link": "Whip/Lash/Validation.html#method_addRule", "name": "Whip\\Lash\\Validation::addRule", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Whip\\Lash\\Validation", "fromLink": "Whip/Lash/Validation.html", "link": "Whip/Lash/Validation.html#method_addRules", "name": "Whip\\Lash\\Validation::addRules", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Whip\\Lash\\Validation", "fromLink": "Whip/Lash/Validation.html", "link": "Whip/Lash/Validation.html#method_getErrors", "name": "Whip\\Lash\\Validation::getErrors", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Whip\\Lash\\Validation", "fromLink": "Whip/Lash/Validation.html", "link": "Whip/Lash/Validation.html#method_validate", "name": "Whip\\Lash\\Validation::validate", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "Whip\\Lash", "fromLink": "Whip/Lash.html", "link": "Whip/Lash/Validator.html", "name": "Whip\\Lash\\Validator", "doc": "&quot;Class Validator&quot;"},
                                                        {"type": "Method", "fromName": "Whip\\Lash\\Validator", "fromLink": "Whip/Lash/Validator.html", "link": "Whip/Lash/Validator.html#method_addCustomValidator", "name": "Whip\\Lash\\Validator::addCustomValidator", "doc": "&quot;Add your own custom validation.&quot;"},
                    {"type": "Method", "fromName": "Whip\\Lash\\Validator", "fromLink": "Whip/Lash/Validator.html", "link": "Whip/Lash/Validator.html#method_addRule", "name": "Whip\\Lash\\Validator::addRule", "doc": "&quot;Add a rule for a named value (ex, a name can be a field in a form post).&quot;"},
                    {"type": "Method", "fromName": "Whip\\Lash\\Validator", "fromLink": "Whip/Lash/Validator.html", "link": "Whip/Lash/Validator.html#method_addRules", "name": "Whip\\Lash\\Validator::addRules", "doc": "&quot;Add multiple rules to validate named values.&quot;"},
                    {"type": "Method", "fromName": "Whip\\Lash\\Validator", "fromLink": "Whip/Lash/Validator.html", "link": "Whip/Lash/Validator.html#method_getErrors", "name": "Whip\\Lash\\Validator::getErrors", "doc": "&quot;Get the errors for fields that failed validation.stringLen&quot;"},
                    {"type": "Method", "fromName": "Whip\\Lash\\Validator", "fromLink": "Whip/Lash/Validator.html", "link": "Whip/Lash/Validator.html#method_validate", "name": "Whip\\Lash\\Validator::validate", "doc": "&quot;&quot;"},
            
            {"type": "Trait", "fromName": "Whip\\Lash\\Validators", "fromLink": "Whip/Lash/Validators.html", "link": "Whip/Lash/Validators/Comparison.html", "name": "Whip\\Lash\\Validators\\Comparison", "doc": "&quot;Trait Comparison&quot;"},
                                                        {"type": "Method", "fromName": "Whip\\Lash\\Validators\\Comparison", "fromLink": "Whip/Lash/Validators/Comparison.html", "link": "Whip/Lash/Validators/Comparison.html#method_gt", "name": "Whip\\Lash\\Validators\\Comparison::gt", "doc": "&quot;Verify that the value is greater than an expected value.&quot;"},
                    {"type": "Method", "fromName": "Whip\\Lash\\Validators\\Comparison", "fromLink": "Whip/Lash/Validators/Comparison.html", "link": "Whip/Lash/Validators/Comparison.html#method_lt", "name": "Whip\\Lash\\Validators\\Comparison::lt", "doc": "&quot;Verify the subject is less than an expected value.&quot;"},
            
            {"type": "Trait", "fromName": "Whip\\Lash\\Validators", "fromLink": "Whip/Lash/Validators.html", "link": "Whip/Lash/Validators/File.html", "name": "Whip\\Lash\\Validators\\File", "doc": "&quot;Class File&quot;"},
                                                        {"type": "Method", "fromName": "Whip\\Lash\\Validators\\File", "fromLink": "Whip/Lash/Validators/File.html", "link": "Whip/Lash/Validators/File.html#method_fileExt", "name": "Whip\\Lash\\Validators\\File::fileExt", "doc": "&quot;Verify a filename contains one of the expected extensions.&quot;"},
                    {"type": "Method", "fromName": "Whip\\Lash\\Validators\\File", "fromLink": "Whip/Lash/Validators/File.html", "link": "Whip/Lash/Validators/File.html#method_fileSize", "name": "Whip\\Lash\\Validators\\File::fileSize", "doc": "&quot;Verify a file size is within (inclusive) an expected range.&quot;"},
            
            {"type": "Trait", "fromName": "Whip\\Lash\\Validators", "fromLink": "Whip/Lash/Validators.html", "link": "Whip/Lash/Validators/FileUpload.html", "name": "Whip\\Lash\\Validators\\FileUpload", "doc": "&quot;Class FileUpload&quot;"},
                                                        {"type": "Method", "fromName": "Whip\\Lash\\Validators\\FileUpload", "fromLink": "Whip/Lash/Validators/FileUpload.html", "link": "Whip/Lash/Validators/FileUpload.html#method_uploadHasExt", "name": "Whip\\Lash\\Validators\\FileUpload::uploadHasExt", "doc": "&quot;Verify a filename contains one of the expected extensions.&quot;"},
                    {"type": "Method", "fromName": "Whip\\Lash\\Validators\\FileUpload", "fromLink": "Whip/Lash/Validators/FileUpload.html", "link": "Whip/Lash/Validators/FileUpload.html#method_uploadName", "name": "Whip\\Lash\\Validators\\FileUpload::uploadName", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "Whip\\Lash\\Validators\\FileUpload", "fromLink": "Whip/Lash/Validators/FileUpload.html", "link": "Whip/Lash/Validators/FileUpload.html#method_uploadHasSize", "name": "Whip\\Lash\\Validators\\FileUpload::uploadHasSize", "doc": "&quot;Verify a file size is within (inclusive) an expected range.&quot;"},
            
            {"type": "Trait", "fromName": "Whip\\Lash\\Validators", "fromLink": "Whip/Lash/Validators.html", "link": "Whip/Lash/Validators/Password.html", "name": "Whip\\Lash\\Validators\\Password", "doc": "&quot;Class Password&quot;"},
                                                        {"type": "Method", "fromName": "Whip\\Lash\\Validators\\Password", "fromLink": "Whip/Lash/Validators/Password.html", "link": "Whip/Lash/Validators/Password.html#method_pass", "name": "Whip\\Lash\\Validators\\Password::pass", "doc": "&quot;&quot;"},
            
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


