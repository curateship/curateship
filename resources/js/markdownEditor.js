import 'ace-builds';
import 'ace-builds/webpack-resolver';

// indicates current selected component
window.currentIndex = -1;

window.selectComponent = (index) => {
  window.currentIndex = index;

  const content = componentInfo[index]['content'];
  htmlEditor.setValue(content);

  const content_php = componentInfo[index]['content_php'];
  phpEditor.setValue(content_php);

  $('.modal__close-btn').trigger('click');
}

window.saveComponentContent = () => {
  if( currentIndex == -1 ) {
	toastr.warning('Please select the component.');
    return;
  }

  const id = componentInfo[ currentIndex ].id;
  const content = htmlEditor.getValue();
  const content_php = phpEditor.getValue();

  $.post('/component/saveContent', {id, content, content_php}, (res) => {
    const data = JSON.parse(res);

    if( data.success ) {
      toastr.success(data.message);
      window.location.reload();
    } else {
      toastr.warning(data.message || 'Something went wrong.');
    }
  }).catch(err => {
    console.log(err);
    toastr.warning( 'Something went wrong.' );
  });
}

window.previewComponent = () => {
  const content = htmlEditor.getValue();

  $('#previewPanel').html(content);
}

window.setComponentName = () => {
	if( currentIndex == -1 ) {
		toastr.warning('Please select the component.');
		return;
	}

  const name = componentInfo[currentIndex]['name'];
  
  $('#editComponentNameInput').val( name );
}

window.updateComponentName = () => {
	if( currentIndex == -1 ) {
		toastr.warning('Please select the component.');
		return;
	}

  const id = componentInfo[currentIndex]['id'];
  const name = componentInfo[currentIndex]['name'];
  const updatedName = $('#editComponentNameInput').val();

  if( updatedName == '' || updatedName == name )
    return;
  
  $.post('/component/updateName', {id, updatedName}, (res) => {
    const data = JSON.parse(res);

    if( data.success ) {
      toastr.success( data.message );
      window.location.reload();
    } else {
      toastr.warning( data.message || 'Something went wrong.' );
    }
  }).catch(err => {
    console.log(err);
    toastr.warning( 'Something went wrong.' );
  });
}

window.deleteComponent = () => {
	if( currentIndex == -1 ) {
		toastr.warning('Please select the component.');
		return;
	}

  if( confirm('Do you really want to delete this component?') ) {
    const id = componentInfo[currentIndex]['id'];
    
    $.post('/component/deleteComponent', { id }, (res) => {
      const data = JSON.parse(res);

      if( data.success ) {
        toastr.success( data.message );
        window.location.reload();
      } else {
        toastr.warning( data.message || 'Something went wrong.' );
      }
    }).catch(err => {
      console.log(err);
      toastr.warning( 'Something went wrong.' );
    });
  }
}

window.copyShortCode = (index) => {
  const category = componentInfo[index]['category'];
  const name = componentInfo[index]['name'];

  const text = `<x-`+ category +`.`+ name +` />`;

  navigator.clipboard.writeText(text);

  toastr.success('Copied');
}

$('#createComponentBtn').click(() => {
  const val = $('#createComponentName').val();
  const category = $('#createComponentCategory').val();

  $.post('/component/add', { name: val, category: category }, (res) => {
    const data = JSON.parse(res);

    if( data.success ) {
      toastr.success(data.message);
      window.location.reload();
    } else {
      toastr.warning(data.message || 'Something went wrong.');
    }
  }).catch(err => {
    console.log(err);
    toastr.warning( 'Something went wrong.' );
  });
});

const init = () => {
	const htmlEditorElement = document.getElementById('htmlEditor');
	// If we have an editor element
	if(htmlEditorElement){
		// pass options to ace.edit
		window.htmlEditor = ace.edit(document.getElementById('htmlEditor'), {
			mode: "ace/mode/php",
			theme: "ace/theme/twilight",
			maxLines: 50,
			minLines: 10,
			fontSize: 18
		})
	
		// use setOptions method to set several options at once
		htmlEditor.setOptions({
			autoScrollEditorIntoView: true,
			copyWithEmptySelection: true,
		});

		htmlEditor.setValue('');
	}

	const phpEditorElement = document.getElementById('phpEditor');
	// If we have an editor element
	if(phpEditorElement){
		// pass options to ace.edit
		window.phpEditor = ace.edit(document.getElementById('phpEditor'), {
			mode: "ace/mode/php",
			theme: "ace/theme/twilight",
			maxLines: 50,
			minLines: 10,
			fontSize: 18
		})
	
		// use setOptions method to set several options at once
		phpEditor.setOptions({
			autoScrollEditorIntoView: true,
			copyWithEmptySelection: true,
		});

		phpEditor.session.setMode({path:"ace/mode/php", inline:true})

		phpEditor.setValue('');
	}
}

init();