This extension forces htmlArea RTE to automatically paste the clipboard content as plain text.

It basically adds an event handler that fires when something is going to be pasted.
If the clipboard content cannot be retrieved by the script (e.g. because of the browser's security settings or if the browser does not support direct access to the clipboard contents), a layer containing a textarea will be opened. After pasting to this textarea the text is being inserted at the current caret position.

So far tested and working in
– Firefox 3.0+
– Internet Explorer 6+
– Google Chrome 2.0+

For more information please check the manual.

Please report all bugs!