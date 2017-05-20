Handlebars.registerHelper('ifeq', function (value, test, options) {
  if (value == test) { return options.fn(this); }
  else { return options.inverse(this); }
});
Handlebars.registerHelper('ifnoteq', function (value, test, options) {
  if (value != test) { return options.fn(this); }
  else { return options.inverse(this); }
});
Handlebars.registerHelper('ifIsFolder', function (options) {
  return this.hasOwnProperty('items') ? options.fn(this) : options.inverse(this);
});
Handlebars.registerHelper('generateRequestID', function (options) {
  var attrs = [];

  for (var prop in options.hash) {
    attrs.push(options.hash[prop]);
  }

  return new Handlebars.SafeString(
    attrs.join('_').replace(/\s+/g, '')
  );
});
Handlebars.registerHelper('sanitise_snippet', function (language, code) {
  var sanitised_code = code;
  if (language === 'cURL') {
    // handle newlines and carriage returns
    sanitised_code = sanitised_code.replace(/\\n|\\r/g, '\n');
    // replace tabs with 4 spaces
    sanitised_code = sanitised_code.replace(/\\t/g, '    ');
    return sanitised_code;
  }
  return code;
});
