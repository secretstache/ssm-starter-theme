jQuery(document).ready(function($) {
  if (typeof acf == "undefined") {
    return;
  }

  var thumbs_dir = main.stylesheet_directory + "/lib/ssmpb/thumbs/";

  acf.add_action("append_field/type=flexible_content", function($el) {
    changeOptions($el, "append");
  });

  acf.add_action("remove_field/type=flexible_content", function($el) {
    changeOptions($el, "remove");
  });

  acf.add_action("load", function($el) {
    populate($el, "load");
  });

  function populate(el, action) {
    var column_rows = el.find('div[data-name="section_columns"]').slice(1);
    var page_id = $("#post_ID").val();
    var current_values = [];

    $.ajax({
      url: main.ajax_url,
      type: "post",
      async: false,
      ContentType: "application/json",
      data: {
        action: "get_width_values",
        page_id: page_id,
        columns_count: column_rows.length
      },
      success: function(html) {
        current_values = JSON.parse(html);
      }
    });

    if ($("#columns_count").length == 0) {
      $("<input>")
        .attr({
          type: "hidden",
          id: "columns_count",
          name: "columns_count",
          value: column_rows.length
        })
        .appendTo($("#post"));
    }

    $.each(column_rows, function(counter) {
      var node_length = $(this)
        .children(".acf-input")
        .children(".acf-repeater")
        .children(".acf-table")
        .children("tbody")
        .children("tr").length;
      node_length -= 1;

      var options = [];

      switch (node_length) {
        case 1:
          options = ["10", "8"];
          thumb = [
            '<img class="thumbs" src="' +
              thumbs_dir +
              '10.png" alt="10 thumb"/>',
            '<img class="thumbs" src="' + thumbs_dir + '8.png" alt="8 thumb"/>'
          ];
          break;
        case 2:
          options = ["7_5", "5_7", "6_6"];
          thumb = [
            '<img class="thumbs" src="' +
              thumbs_dir +
              '7_5.png" alt="7_5 thumb"/>',
            '<img class="thumbs" src="' +
              thumbs_dir +
              '5_7.png" alt="5_7 thumb"/>',
            '<img class="thumbs" src="' +
              thumbs_dir +
              '6_6.png" alt="6_6 thumb"/>'
          ];
          break;
        case 3:
          options = ["6_3_3", "3_3_6", "4_4_4"];
          thumb = [
            '<img class="thumbs" src="' +
              thumbs_dir +
              '6_3_3.png" alt="6_3_3 thumb"/>',
            '<img class="thumbs" src="' +
              thumbs_dir +
              '3_3_6.png" alt="3_3_6 thumb"/>',
            '<img class="thumbs" src="' +
              thumbs_dir +
              '4_4_4.png" alt="4_4_4 thumb"/>'
          ];
          break;
        case 4:
          options = ["3_3_3_3"];
          thumb = [
            '<img class="thumbs" src="' +
              thumbs_dir +
              '3_3_3_3.png" alt="3_3_3_3 thumb"/>'
          ];
          break;
      }

      var ul = $(this)
        .parents("div.acf-fields")
        .children('div[data-name="columns_width"]')
        .find("ul.acf-radio-list");
      ul.empty();

      for (i = 0; i < options.length; i++) {
        var value = current_values[counter];

        if (value == options[i]) {
          var li =
            '<li><label class="selected"><input type="radio" name="columns_width_' +
            counter +
            '" value="' +
            options[i] +
            '" checked="checked">' +
            thumb[i] +
            "</label></li>";
        } else {
          var li =
            '<li><label><input type="radio" name="columns_width_' +
            counter +
            '" value="' +
            options[i] +
            '">' +
            thumb[i] +
            "</label></li>";
        }

        ul.prepend(li);
      }
    });
  }

  function changeOptions(el, action) {
    var column_rows = $('div[data-name="section_columns"]').slice(1);
    $("input#columns_count").val(column_rows.length);

    var node_length = el
      .parents(".acf-table")
      .children("tbody")
      .children("tr").length;
    var column_count = parseInt(
      el
        .parents(".acf-fields")
        .prevAll(".acf-fc-layout-handle")
        .find(".acf-fc-layout-order")
        .text()
    );

    if (!isNaN(column_count)) {
      if (action == "remove") {
        node_length -= 2;
      } else {
        node_length -= 1;
      }

      var options = [];

      switch (node_length) {
        case 1:
          options = ["10", "8"];
          thumb = [
            '<img class="thumbs" src="' +
              thumbs_dir +
              '10.png" alt="10 thumb"/>',
            '<img class="thumbs" src="' + thumbs_dir + '8.png" alt="8 thumb"/>'
          ];
          break;
        case 2:
          options = ["7_5", "5_7", "6_6"];
          thumb = [
            '<img class="thumbs" src="' +
              thumbs_dir +
              '7_5.png" alt="7_5 thumb"/>',
            '<img class="thumbs" src="' +
              thumbs_dir +
              '5_7.png" alt="5_7 thumb"/>',
            '<img class="thumbs" src="' +
              thumbs_dir +
              '6_6.png" alt="6_6 thumb"/>'
          ];
          break;
        case 3:
          options = ["6_3_3", "3_3_6", "4_4_4"];
          thumb = [
            '<img class="thumbs" src="' +
              thumbs_dir +
              '6_3_3.png" alt="6_3_3 thumb"/>',
            '<img class="thumbs" src="' +
              thumbs_dir +
              '3_3_6.png" alt="3_3_6 thumb"/>',
            '<img class="thumbs" src="' +
              thumbs_dir +
              '4_4_4.png" alt="4_4_4 thumb"/>'
          ];
          break;
        case 4:
          options = ["3_3_3_3"];
          thumb = [
            '<img class="thumbs" src="' +
              thumbs_dir +
              '3_3_3_3.png" alt="3_3_3_3 thumb"/>'
          ];
          break;
      }

      var ul = el
        .parents("div.acf-fields")
        .children('div[data-name="columns_width"]')
        .find("ul.acf-radio-list");
      ul.empty();

      column_count -= 1;

      for (i = 0; i < options.length; i++) {
        var li =
          '<li><label><input type="radio" name="columns_width_' +
          column_count +
          '" value="' +
          options[i] +
          '" >' +
          thumb[i] +
          "</label></li>";
        ul.prepend(li);
      }
    }
  }
});
