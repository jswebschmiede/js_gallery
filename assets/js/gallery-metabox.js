jQuery(function ($) {
	var file_frame;

	function makeSortable() {
		jQuery("#gallery-metabox-list").sortable({
			opacity: 0.6,
			stop: function () {
				resetIndex();
			},
		});
	}

	function resetIndex() {
		jQuery("#gallery-metabox-list li").each(function (i) {
			jQuery(this)
				.find("input:hidden")
				.attr("name", "js-gallery_gallery_id[" + i + "]");
		});
	}

	$(document).on("click", "a.gallery-add", function (e) {
		e.preventDefault();

		if (file_frame) file_frame.close();

		file_frame = wp.media.frames.file_frame = wp.media({
			title: $(this).data("uploader-title"),
			button: {
				text: $(this).data("uploader-button-text"),
			},
			multiple: "add",
		});

		file_frame.on("select", function () {
			attachments = file_frame.state().get("selection").toJSON();
			$.each(attachments, function (i, attachment) {
				$("#gallery-metabox-list").append(
					'<li><input type="hidden" name="js-gallery_gallery_id[]" value="' +
						attachment.id +
						'"><img class="image-preview" src="' +
						attachment.url +
						'"><a class="change-image button" href="#">' +
						$("a.gallery-add").data("uploader-title") +
						'</a><br><small><a class="remove-image delete" href="#">' +
						$("a.gallery-add").data("uploader-remove-text") +
						"</a></small></li>"
				);
			});
		});
		makeSortable();
		file_frame.open();
	});

	$(document).on("click", "a.remove-image", function (e) {
		e.preventDefault();
		$(this)
			.parents("li")
			.animate({ opacity: 0 }, 200, function () {
				$(this).remove();
				resetIndex();
			});
	});

	$(document).on("click", "a.change-image", function (e) {
		e.preventDefault();

		var that = $(this);

		if (file_frame) file_frame.close();

		file_frame = wp.media.frames.file_frame = wp.media({
			title: $(this).data("uploader-title"),
			button: {
				text: $(this).data("uploader-button-text"),
			},
			multiple: false,
		});

		file_frame.on("select", function () {
			attachment = file_frame.state().get("selection").first().toJSON();

			that.parent().find("input:hidden").attr("value", attachment.id);
			that.parent().find("img.image-preview").attr("src", attachment.url);
		});

		file_frame.open();
	});
	makeSortable();
});
