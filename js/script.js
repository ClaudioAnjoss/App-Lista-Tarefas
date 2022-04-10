function editar(id, tarefa) {

    //Formulario
    let form = document.createElement('form');
    form.action='scripts/tarefa_controller.php?acao=atualizar';
    form.method='post';
    form.className='row';

    //Input
    let input = document.createElement('input');
    input.type='text';
    input.name='tarefa'
    input.className='form-control col-md-9';
    input.value=tarefa;

    let inputID = document.createElement('input');
    inputID.type='hidden';
    inputID.name='id';
    inputID.value=id;

    //Botão
    let button = document.createElement('button');
    button.className='btn btn-info col-md-3';
    button.type='submit';
    button.innerHTML='Atualizar';

    //Inclusão do input e botão no formulario
    form.appendChild(input);
    form.appendChild(inputID);
    form.appendChild(button);

    //Inserindo o conteudo no formulario
    let div_tarefa = document.getElementById('tarefa_' + id);

    div_tarefa.innerHTML = '';

    div_tarefa.insertBefore(form, div_tarefa[0]);

}

function excluir(id) {
    location.href = 'todas_tarefas.php?acao=remover&id='+id;    
}