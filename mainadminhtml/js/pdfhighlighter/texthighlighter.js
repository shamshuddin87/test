function getHightlightCoords() {
  var pageIndex = window.PDFViewerApplication.pdfViewer.currentPageNumber - 1;
  var page = window.PDFViewerApplication.pdfViewer.pages[pageIndex];
  var pageRect = page.canvas.getClientRects()[0];
  var selectionRects = window.getSelection().getRangeAt(0).getClientRects();
  var viewport = page.viewport;
  var selected = _.map(selectionRects, function (r) {
    return viewport.convertToPdfPoint(r.left - pageRect.left, r.top - pageRect.top).concat(
       viewport.convertToPdfPoint(r.right - pageRect.left, r.bottom - pageRect.top));
  })
  return {page: pageIndex, coords: selected};
}

function showHighlight(selected) {
  var pageIndex = selected.page;
  var page = PDFViewerApplication.pdfViewer.pages[pageIndex];
  var pageElement = page.canvas.parentElement;
  var viewport = page.viewport;
  selected.coords.forEach(function (rect) {
    var bounds = viewport.convertToViewportRectangle(rect);
    var el = document.createElement('div');
    el.setAttribute('style', 'position: absolute; background-color: rgba(238, 170, 0, .2);' +
      'left:' + Math.min(bounds[0], bounds[2]) + 'px; top:' + Math.min(bounds[1], bounds[3]) + 'px;' +
      'width:' + Math.abs(bounds[0] - bounds[2]) + 'px; height:' + Math.abs(bounds[1] - bounds[3]) + 'px;');
    pageElement.appendChild(el);
  })
}