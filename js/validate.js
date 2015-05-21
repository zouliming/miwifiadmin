/*!
 * validate.js 1.2.2
 * Copyright (c) 2013 Rick Harrison, http://rickharrison.me
 * validate.js is open sourced under the MIT license.
 * Portions of validate.js are inspired by CodeIgniter.
 * http://rickharrison.github.com/validate.js
 */

(function(window, document, undefined) {
    /*
     * If you would like an application-wide config, change these defaults.
     * Otherwise, use the setMessage() function to configure form specific messages.
     */

    var defaults = {
        messages: {
            required: '%s不能为空',
            matches: '%s输入与%s不一致',
            not_matches: '%s输入与%s不能相同',
            valid_email: '%s必须是邮箱地址',
            valid_emails: '%s必须全是邮箱地址',
            min_length: '%s不能少于%s位',
            max_length: ' %s不能大于%s位',
            min_byte_len: '%s不能少于%s个字节',
            max_byte_len: '%s不能大于%s个字节',
            exact_length: '%s必须等于%s位',
            greater_than: '%s必须大于%s',
            less_than: '%s必须小于%s',
            greater_than_el: '%s必须大于%s',
            less_than_el: '%s必须小于%s',
            alpha: '%s必须是字母',
            alpha_numeric: '%s必须有字母数字组成',
            alpha_dash: '%s必须由字母，数字，下划线和破折号组成',
            numeric: '%s必须是数字',
            integer: '%s必须是整数',
            decimal: '%s必须是小数',
            is_natural: '%s必须是正整数',
            is_natural_no_zero: '%s必须大于零的整数',
            valid_ip: 'IP地址由4个 0~255 之间的数字组成，数字之间用点区隔',
            valid_base64: '%s必须是base64位字符',
            valid_credit_card: '%s必须是信用卡号',
            is_file_type: '%s必须是%s类型的文件',
            valid_url: '%s必须是完整的URL,如 http://miwifi.com',
            haschina: '%s不能包含中文',
            valid_ssid: '请输入标准字符，如 Xiaomi.Luyouqi',
            valid_mac: 'MAC地址格式有误，如ab:cd:ef:11:22:33'
        },
        callback: function(errors, event) {
            var root = this.form;
            $('.item', root).removeClass('item-err');
            $('.item .t', root).hide();

            if (errors.length > 0) {
                for (var i = 0; i < errors.length; i++) {
                    var item = root[errors[i].name].parentNode.parentNode;
                    $(item).addClass('item-err');
                    $('.t', item).html(errors[i].message+'<i class="dur"></i>').show();
                };
            };
        }
    };

    /*
    * Help method
    */
    var byteLen = function(s) {
        s = utf8.encode(s);
        return s.length;
    };
    /*
     * Define the regular expressions that will be used
     */

    var ruleRegex = /^(.+?)\[(.+)\]$/,
        numericRegex = /^[0-9]+$/,
        integerRegex = /^\-?[0-9]+$/,
        decimalRegex = /^\-?[0-9]*\.?[0-9]+$/,
        emailRegex = /^[a-zA-Z0-9.!#$%&amp;'*+\-\/=?\^_`{|}~\-]+@[a-zA-Z0-9\-]+(?:\.[a-zA-Z0-9\-]+)*$/,
        alphaRegex = /^[a-z]+$/i,
        alphaNumericRegex = /^[a-z0-9]+$/i,
        alphaDashRegex = /^[a-z0-9_\-]+$/i,
        naturalRegex = /^[0-9]+$/i,
        naturalNoZeroRegex = /^[1-9][0-9]*$/i,
        ipRegex = /^((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){3}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})$/i,
        base64Regex = /[^a-zA-Z0-9\/\+=]/i,
        numericDashRegex = /^[\d\-\s]+$/,
        urlRegex = /^((http|https):\/\/(\w+:{0,1}\w*@)?(\S+)|)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?$/,
        ssidRegex = /^[a-z0-9][a-z0-9\-._]*[a-z0-9]$/i,
        macRegex = /^[0-9a-f]{2}(:[0-9a-f]{2}){5}$/i;

    /*
     * The exposed public object to validate a form:
     *
     * @param formName - String - The name attribute of the form (i.e. <form name="myForm"></form>)
     * @param fields - Array - [{
     *     name: The name of the element (i.e. <input name="myField" />)
     *     display: 'Field Name'
     *     rules: required|matches[password_confirm]
     * }]
     * @param callback - Function - The callback after validation has been performed.
     *     @argument errors - An array of validation errors
     *     @argument event - The javascript event
     */

    var FormValidator = function(formName, fields, callback) {
        var that = this;

        this.callback = callback || defaults.callback;
        this.errors = [];
        this.fields = {};
        this.form = document.forms[formName] || {};
        this.messages = {};
        this.handlers = {};

        for (var i = 0, fieldLength = fields.length; i < fieldLength; i++) {
            var field = fields[i];

            // If passed in incorrectly, we need to skip the field.
            if (!field.name || !field.rules) {
                continue;
            }

            /*
             * Build the master fields array that has all the information needed to validate
             */

            this.fields[field.name] = {
                name: field.name,
                display: field.display || field.name,
                rules: field.rules,
                id: null,
                type: null,
                value: null,
                checked: null,
                msg: field.msg || ''
            };

            $(this.form[field.name]).on('blur', function(e){
                console.log(this,'blur');
                that._validateForm();
            });
        }

        this._validateForm();
    },

    attributeValue = function (element, attributeName) {
        var i;

        if ((element.length > 0) && (element[0].type === 'radio')) {
            for (i = 0; i < element.length; i++) {
                if (element[i].checked) {
                    return element[i][attributeName];
                }
            }

            return;
        }

        return element[attributeName];
    };

    /*
     * @public
     * Sets a custom message for one of the rules
     */

    FormValidator.prototype.setMessage = function(rule, message) {
        this.messages[rule] = message;

        // return this for chaining
        return this;
    };

    /*
     * @public
     * Registers a callback for a custom rule (i.e. callback_username_check)
     */

    FormValidator.prototype.registerCallback = function(name, handler) {
        if (name && typeof name === 'string' && handler && typeof handler === 'function') {
            this.handlers[name] = handler;
        }

        // return this for chaining
        return this;
    };

    /*
     * @private
     * Runs the validation when the form is submitted.
     */

    FormValidator.prototype._validateForm = function() {
        this.errors = [];

        for (var key in this.fields) {
            if (this.fields.hasOwnProperty(key)) {
                var field = this.fields[key] || {},
                    element = this.form[field.name];

                if (element && element !== undefined) {
                    field.id = attributeValue(element, 'id');
                    field.type = (element.length > 0) ? element[0].type : element.type;
                    field.value = attributeValue(element, 'value');
                    field.value = $.trim(field.value);
                    field.checked = attributeValue(element, 'checked');

                    /*
                     * Run through the rules for each field.
                     */

                    this._validateField(field);
                }
            }
        }

        if (typeof this.callback === 'function') {
            this.callback.apply(this, [this.errors]);
        }

        if (this.errors.length > 0) {
            return false;
        }

        return true;
    };

    /*
     * @private
     * Looks at the fields value and evaluates it against the given rules
     */

    FormValidator.prototype._validateField = function(field) {
        var rules = field.rules.split('|');

        /*
         * If the value is null and not required, we don't need to run through validation, unless the rule is a callback, but then only if the value is not null
         */

        if ( (field.rules.indexOf('required') === -1 && (!field.value || field.value === '' || field.value === undefined)) && (field.rules.indexOf('callback_') === -1 || field.value === null) ) {
            return;
        }

        /*
         * Run through the rules and execute the validation methods as needed
         */

        for (var i = 0, ruleLength = rules.length; i < ruleLength; i++) {
            var method = rules[i],
                param = null,
                failed = false,
                parts = ruleRegex.exec(method);

            /*
             * If the rule has a parameter (i.e. matches[param]) split it out
             */

            if (parts) {
                method = parts[1];
                param = parts[2];
            }

            /*
             * If the hook is defined, run it to find any validation errors
             */

            if (typeof this._hooks[method] === 'function') {
                if (!this._hooks[method].apply(this, [field, param])) {
                    failed = true;
                }
            } else if (method.substring(0, 9) === 'callback_') {
                // Custom method. Execute the handler if it was registered
                method = method.substring(9, method.length);

                if (typeof this.handlers[method] === 'function') {
                    if (this.handlers[method].apply(this, [field.value]) === false) {
                        failed = true;
                    }
                }
            }

            /*
             * If the hook failed, add a message to the errors array
             */

            if (failed) {
                // Make sure we have a message for this rule
                var source = field.msg[method] || this.messages[method] || defaults.messages[method],
                    message = field.display + ' 输入有误';

                if (source) {
                    message = source.replace('%s', field.display);

                    if (param) {
                        message = message.replace('%s', (this.fields[param]) ? this.fields[param].display : param);
                    }
                }

                this.errors.push({
                    id: field.id,
                    name: field.name,
                    message: message,
                    rule: method
                });

                // Break out so as to not spam with validation errors (i.e. required and valid_email)
                break;
            }
        }
    };

    /*
     * @private
     * Object containing all of the validation hooks
     */

    FormValidator.prototype._hooks = {
        required: function(field) {
            var value = field.value;

            if ((field.type === 'checkbox') || (field.type === 'radio')) {
                return (field.checked === true);
            }

            return (value !== null && value !== '');
        },

        matches: function(field, matchName) {
            var el = this.form[matchName];

            if (el) {
                return field.value === el.value;
            }

            return false;
        },

        not_matches: function(field, matchName) {
            var el = this.form[matchName];

            if (el) {
                return field.value !== el.value;
            }

            return false;
        },

        valid_email: function(field) {
            return emailRegex.test(field.value);
        },

        valid_emails: function(field) {
            var result = field.value.split(",");

            for (var i = 0; i < result.length; i++) {
                if (!emailRegex.test(result[i])) {
                    return false;
                }
            }

            return true;
        },

        min_length: function(field, length) {
            if (!numericRegex.test(length)) {
                return false;
            }

            return (field.value.length >= parseInt(length, 10));
        },

        max_length: function(field, length) {
            if (!numericRegex.test(length)) {
                return false;
            }

            return (field.value.length <= parseInt(length, 10));
        },

        min_byte_len: function(field, length) {
            if (!numericRegex.test(length)) {
                return false;
            }

            return (byteLen(field.value) >= parseInt(length, 10));
        },

        max_byte_len: function(field, length) {
            if (!numericRegex.test(length)) {
                return false;
            }

            return (byteLen(field.value) <= parseInt(length, 10));
        },

        exact_length: function(field, length) {
            if (!numericRegex.test(length)) {
                return false;
            }

            return (field.value.length === parseInt(length, 10));
        },

        greater_than: function(field, param) {
            if (!decimalRegex.test(field.value)) {
                return false;
            }

            return (parseFloat(field.value) > parseFloat(param));
        },

        greater_than_el: function(field, matchName) {
            if (!decimalRegex.test(field.value)) {
                return false;
            }
            var el = this.form[matchName];
            if (el) {
                return parseFloat(field.value) > parseFloat(el.value);
            }
            return false;
        },

        less_than: function(field, param) {
            if (!decimalRegex.test(field.value)) {
                return false;
            }

            return (parseFloat(field.value) < parseFloat(param));
        },

        less_than_el: function(field, matchName) {
            if (!decimalRegex.test(field.value)) {
                return false;
            }
            var el = this.form[matchName];
            if (el) {
                return parseFloat(field.value) < parseFloat(el.value);
            }
            return false;
        },

        alpha: function(field) {
            return (alphaRegex.test(field.value));
        },

        alpha_numeric: function(field) {
            return (alphaNumericRegex.test(field.value));
        },

        alpha_dash: function(field) {
            return (alphaDashRegex.test(field.value));
        },

        numeric: function(field) {
            return (decimalRegex.test(field.value));
        },

        integer: function(field) {
            return (integerRegex.test(field.value));
        },

        decimal: function(field) {
            return (decimalRegex.test(field.value));
        },

        is_natural: function(field) {
            return (naturalRegex.test(field.value));
        },

        is_natural_no_zero: function(field) {
            return (naturalNoZeroRegex.test(field.value));
        },

        valid_ip: function(field) {
            return (ipRegex.test(field.value));
        },

        valid_base64: function(field) {
            return (base64Regex.test(field.value));
        },

        valid_url: function(field) {
            return (urlRegex.test(field.value));
        },

        valid_credit_card: function(field){
            // Luhn Check Code from https://gist.github.com/4075533
            // accept only digits, dashes or spaces
            if (!numericDashRegex.test(field.value)) return false;

            // The Luhn Algorithm. It's so pretty.
            var nCheck = 0, nDigit = 0, bEven = false;
            var strippedField = field.value.replace(/\D/g, "");

            for (var n = strippedField.length - 1; n >= 0; n--) {
                var cDigit = strippedField.charAt(n);
                nDigit = parseInt(cDigit, 10);
                if (bEven) {
                    if ((nDigit *= 2) > 9) nDigit -= 9;
                }

                nCheck += nDigit;
                bEven = !bEven;
            }

            return (nCheck % 10) === 0;
        },

        is_file_type: function(field,type) {
            if (field.type !== 'file') {
                return true;
            }

            var ext = field.value.substr((field.value.lastIndexOf('.') + 1)),
                typeArray = type.split(','),
                inArray = false,
                i = 0,
                len = typeArray.length;

            for (i; i < len; i++) {
                if (ext == typeArray[i]) inArray = true;
            }

            return inArray;
        },
        haschina: function(field){
            return (escape(field.value).indexOf("%u") < 0);
        },
        valid_ssid: function(field){
            if ( field.value.length == 0 ) {
                return false;
            }
            if ( field.value.length == 1 ) {
                return /[a-z0-9]/i.test(field.value)
            }
            return (ssidRegex.test(field.value));
        },
        valid_mac: function(field){
            return (macRegex.test(field.value) && field.value !== '00:00:00:00:00:00' && field.value !== 'ff:ff:ff:ff:ff:ff');
        }
    };

    FormValidator.checkAll = function(frm, rules){
        var valid = new FormValidator(frm, rules);
        return valid._validateForm();
    };

    window.FormValidator = FormValidator;

})(window, document);
