prompt PL/SQL Developer import file
prompt Created on sexta-feira, 22 de março de 2013 by Usuario
set feedback off
set define off
prompt Disabling triggers for USUARIO...
alter table USUARIO disable all triggers;
prompt Disabling triggers for USUARIO_GRUPO...
alter table USUARIO_GRUPO disable all triggers;
prompt Disabling triggers for UF...
alter table UF disable all triggers;
prompt Disabling triggers for CIDADE...
alter table CIDADE disable all triggers;
prompt Disabling triggers for EMPRESA...
alter table EMPRESA disable all triggers;
prompt Disabling triggers for TIPO_PAGAMENTO...
alter table TIPO_PAGAMENTO disable all triggers;
prompt Disabling triggers for FORMAS_PAGAMENTO...
alter table FORMAS_PAGAMENTO disable all triggers;
prompt Disabling triggers for CARTAO_CREDITO...
alter table CARTAO_CREDITO disable all triggers;
prompt Disabling triggers for CARTAO_CREDITO_PARAMETROS...
alter table CARTAO_CREDITO_PARAMETROS disable all triggers;
prompt Disabling triggers for CATEG_ENTIDADE...
alter table CATEG_ENTIDADE disable all triggers;
prompt Disabling triggers for FINANCEIRAS...
alter table FINANCEIRAS disable all triggers;
prompt Disabling triggers for FINANCEIRAS_PARCELAS...
alter table FINANCEIRAS_PARCELAS disable all triggers;
prompt Disabling triggers for COND_PAG...
alter table COND_PAG disable all triggers;
prompt Disabling triggers for COND_PAG_PARC...
alter table COND_PAG_PARC disable all triggers;
prompt Disabling triggers for TABELA_PRECO...
alter table TABELA_PRECO disable all triggers;
prompt Disabling triggers for CONFIG_EMPRESA...
alter table CONFIG_EMPRESA disable all triggers;
prompt Disabling triggers for EMPRESA_ATUACAO...
alter table EMPRESA_ATUACAO disable all triggers;
prompt Disabling triggers for ENTIDADE...
alter table ENTIDADE disable all triggers;
prompt Disabling triggers for ENT_FONE...
alter table ENT_FONE disable all triggers;
prompt Disabling triggers for PRODUTO_GRUPO...
alter table PRODUTO_GRUPO disable all triggers;
prompt Disabling triggers for PRODUTO_SUBGRUPO...
alter table PRODUTO_SUBGRUPO disable all triggers;
prompt Disabling triggers for PRODUTO...
alter table PRODUTO disable all triggers;
prompt Disabling triggers for FICHA_TECNICA...
alter table FICHA_TECNICA disable all triggers;
prompt Disabling triggers for FICHA_TECNICA_ITEM...
alter table FICHA_TECNICA_ITEM disable all triggers;
prompt Disabling triggers for ORCAMENTO...
alter table ORCAMENTO disable all triggers;
prompt Disabling triggers for JUSTIFICATIVAS...
alter table JUSTIFICATIVAS disable all triggers;
prompt Disabling triggers for ORCAMENTO_ITEM...
alter table ORCAMENTO_ITEM disable all triggers;
prompt Disabling triggers for PESQUISAS_PERGUNTAS...
alter table PESQUISAS_PERGUNTAS disable all triggers;
prompt Disabling triggers for PESQUISAS_PERGUNTAS_OPCOES...
alter table PESQUISAS_PERGUNTAS_OPCOES disable all triggers;
prompt Disabling triggers for PESQUISAS_RESPOSTAS...
alter table PESQUISAS_RESPOSTAS disable all triggers;
prompt Disabling triggers for PRODUTO_IMAGEM...
alter table PRODUTO_IMAGEM disable all triggers;
prompt Disabling triggers for TABELA_PRECO_ITEM...
alter table TABELA_PRECO_ITEM disable all triggers;
prompt Disabling triggers for UNIDADE_MEDIDA...
alter table UNIDADE_MEDIDA disable all triggers;
prompt Disabling triggers for USUARIO_ACESSO...
alter table USUARIO_ACESSO disable all triggers;
prompt Disabling triggers for USUARIO_EMPRESA...
alter table USUARIO_EMPRESA disable all triggers;
prompt Disabling triggers for USUARIO_GRUPO_EMPRESA...
alter table USUARIO_GRUPO_EMPRESA disable all triggers;
prompt Disabling triggers for USUARIO_GRUPO_RESTRICAO...
alter table USUARIO_GRUPO_RESTRICAO disable all triggers;
prompt Disabling triggers for USUARIO_RESTRICAO...
alter table USUARIO_RESTRICAO disable all triggers;
prompt Disabling foreign key constraints for USUARIO...
alter table USUARIO disable constraint FK_USUGRUCOD;
prompt Disabling foreign key constraints for USUARIO_GRUPO...
alter table USUARIO_GRUPO disable constraint FK_USU_GRU_USUARIO;
prompt Disabling foreign key constraints for CIDADE...
alter table CIDADE disable constraint FK_CIDADE_UF;
prompt Disabling foreign key constraints for EMPRESA...
alter table EMPRESA disable constraint FK_EMPRESA_CIDADE;
alter table EMPRESA disable constraint FK_EMPRESA_USUARIO;
prompt Disabling foreign key constraints for TIPO_PAGAMENTO...
alter table TIPO_PAGAMENTO disable constraint FK_TIPOPAGAMENTO_EMPRESA;
alter table TIPO_PAGAMENTO disable constraint FK_TIPOPAGAMENTO_USUARIO;
prompt Disabling foreign key constraints for FORMAS_PAGAMENTO...
alter table FORMAS_PAGAMENTO disable constraint FK_FORPAG_EMPRESA;
alter table FORMAS_PAGAMENTO disable constraint FK_FORPAG_TIPOPAG;
alter table FORMAS_PAGAMENTO disable constraint FK_FORPAG_USUARIO;
prompt Disabling foreign key constraints for CARTAO_CREDITO...
alter table CARTAO_CREDITO disable constraint FK_CARCRE_EMPRESA;
alter table CARTAO_CREDITO disable constraint FK_CARCRE_FORPAG;
alter table CARTAO_CREDITO disable constraint FK_CARCRE_USUARIO;
prompt Disabling foreign key constraints for CARTAO_CREDITO_PARAMETROS...
alter table CARTAO_CREDITO_PARAMETROS disable constraint PR_CARCREPAR_CARCRE;
prompt Disabling foreign key constraints for CATEG_ENTIDADE...
alter table CATEG_ENTIDADE disable constraint FK_CATEG_ENTIDADE_EMPRESA;
prompt Disabling foreign key constraints for FINANCEIRAS...
alter table FINANCEIRAS disable constraint FK_FINANC_EMPRESA;
alter table FINANCEIRAS disable constraint FK_FINANC_USUARIO;
prompt Disabling foreign key constraints for FINANCEIRAS_PARCELAS...
alter table FINANCEIRAS_PARCELAS disable constraint FK_FINPAR_EMPRES;
alter table FINANCEIRAS_PARCELAS disable constraint FK_FINPAR_FINANCEIRA;
alter table FINANCEIRAS_PARCELAS disable constraint FK_FINPAR_USUARIO;
prompt Disabling foreign key constraints for COND_PAG...
alter table COND_PAG disable constraint FK_COND_PAG_FIN_PAR;
alter table COND_PAG disable constraint FK_COND_PAG_FOR_PAG;
alter table COND_PAG disable constraint FK_COND_PAG_USUARIO;
prompt Disabling foreign key constraints for COND_PAG_PARC...
alter table COND_PAG_PARC disable constraint FK_COND_PAG_PARC_CP;
prompt Disabling foreign key constraints for TABELA_PRECO...
alter table TABELA_PRECO disable constraint FK_TAB_PRE_EMPRESA;
alter table TABELA_PRECO disable constraint FK_TAB_PRE_USUARIO;
prompt Disabling foreign key constraints for CONFIG_EMPRESA...
alter table CONFIG_EMPRESA disable constraint FK_CONEMP_TABPRE;
prompt Disabling foreign key constraints for EMPRESA_ATUACAO...
alter table EMPRESA_ATUACAO disable constraint FK_EMPATU_CIDADE;
alter table EMPRESA_ATUACAO disable constraint FK_EMPATU_EMPRESA;
alter table EMPRESA_ATUACAO disable constraint FK_EMPATU_USUARIO;
prompt Disabling foreign key constraints for ENTIDADE...
alter table ENTIDADE disable constraint FK_ENTIDADE_CATEG_ENTIDADE;
alter table ENTIDADE disable constraint FK_ENTIDADE_CIDADE;
alter table ENTIDADE disable constraint FK_ENTIDADE_CIDADE_COB;
alter table ENTIDADE disable constraint FK_ENTIDADE_EMPRES;
alter table ENTIDADE disable constraint FK_ENTIDADE_REPRES;
alter table ENTIDADE disable constraint FK_ENTIDADE_USUARIO;
prompt Disabling foreign key constraints for ENT_FONE...
alter table ENT_FONE disable constraint FK_ENT_FONE_ENTIDADE;
prompt Disabling foreign key constraints for PRODUTO_GRUPO...
alter table PRODUTO_GRUPO disable constraint FK_GRUPO_USUARIO;
prompt Disabling foreign key constraints for PRODUTO_SUBGRUPO...
alter table PRODUTO_SUBGRUPO disable constraint FK_SUBGRUPO_GRUPO;
alter table PRODUTO_SUBGRUPO disable constraint FK_SUBGRUPO_USUARIO;
prompt Disabling foreign key constraints for PRODUTO...
alter table PRODUTO disable constraint FK_PRODUTO_GRUPO;
alter table PRODUTO disable constraint FK_PRODUTO_SUBGRUPO;
alter table PRODUTO disable constraint FK_PRODUTO_USUARIO;
prompt Disabling foreign key constraints for FICHA_TECNICA...
alter table FICHA_TECNICA disable constraint FK_FICHA_TEC_EMPRESA;
alter table FICHA_TECNICA disable constraint FK_FICHA_TEC_PRODUTO;
alter table FICHA_TECNICA disable constraint FK_FICHA_TEC_USUARIO;
prompt Disabling foreign key constraints for FICHA_TECNICA_ITEM...
alter table FICHA_TECNICA_ITEM disable constraint FK_FIC_TEC_ITE_EMPRESA;
alter table FICHA_TECNICA_ITEM disable constraint FK_FIC_TEC_ITE_FIC_TEC;
alter table FICHA_TECNICA_ITEM disable constraint FK_FIC_TEC_ITE_PRODUTO;
alter table FICHA_TECNICA_ITEM disable constraint FK_FIC_TEC_ITE_USUARIO;
prompt Disabling foreign key constraints for ORCAMENTO...
alter table ORCAMENTO disable constraint FK_ORCAMENTO_COND_PAG;
alter table ORCAMENTO disable constraint FK_ORCAMENTO_EMPRESA;
alter table ORCAMENTO disable constraint FK_ORCAMENTO_ENTIDADE;
alter table ORCAMENTO disable constraint FK_ORCAMENTO_FORMASPAGAMENTO;
alter table ORCAMENTO disable constraint FK_ORCAMENTO_USUARIO;
prompt Disabling foreign key constraints for JUSTIFICATIVAS...
alter table JUSTIFICATIVAS disable constraint FK_JUST_ORCAMENTO;
prompt Disabling foreign key constraints for ORCAMENTO_ITEM...
alter table ORCAMENTO_ITEM disable constraint FK_ORCITE_ORC;
alter table ORCAMENTO_ITEM disable constraint FK_ORCITE_PRO;
alter table ORCAMENTO_ITEM disable constraint FK_ORCITE_USU;
prompt Disabling foreign key constraints for PESQUISAS_PERGUNTAS...
alter table PESQUISAS_PERGUNTAS disable constraint FK_PESPER_EMPRESA;
alter table PESQUISAS_PERGUNTAS disable constraint FK_PESPER_USUARIO;
prompt Disabling foreign key constraints for PESQUISAS_PERGUNTAS_OPCOES...
alter table PESQUISAS_PERGUNTAS_OPCOES disable constraint FK_PESPEROP_PESPER;
alter table PESQUISAS_PERGUNTAS_OPCOES disable constraint FK_PESPEROP_USUARIO;
prompt Disabling foreign key constraints for PESQUISAS_RESPOSTAS...
alter table PESQUISAS_RESPOSTAS disable constraint FK_PESRES_ENTIDADE;
alter table PESQUISAS_RESPOSTAS disable constraint FK_PESRES_PESPER;
prompt Disabling foreign key constraints for PRODUTO_IMAGEM...
alter table PRODUTO_IMAGEM disable constraint FK_PRO_IMA_PRODUTO;
alter table PRODUTO_IMAGEM disable constraint FK_PRO_IMA_USUARIO;
prompt Disabling foreign key constraints for TABELA_PRECO_ITEM...
alter table TABELA_PRECO_ITEM disable constraint FK_TAB_PRE_ITE_EMPRESA;
alter table TABELA_PRECO_ITEM disable constraint FK_TAB_PRE_ITE_TAB_PRE;
alter table TABELA_PRECO_ITEM disable constraint FK_TAB_PRE_ITE_USUARIO;
prompt Disabling foreign key constraints for USUARIO_EMPRESA...
alter table USUARIO_EMPRESA disable constraint FK_USU_EMP_EMPRESA;
alter table USUARIO_EMPRESA disable constraint FK_USU_EMP_USUARIO;
prompt Disabling foreign key constraints for USUARIO_GRUPO_EMPRESA...
alter table USUARIO_GRUPO_EMPRESA disable constraint FK_USU_GRU_EMP_EMP;
alter table USUARIO_GRUPO_EMPRESA disable constraint FK_USU_GRU_EMP_USU_GRU;
prompt Disabling foreign key constraints for USUARIO_RESTRICAO...
alter table USUARIO_RESTRICAO disable constraint FK_USU_REST_USU_ACE;
alter table USUARIO_RESTRICAO disable constraint FK_USU_REST_USUARIO;
prompt Deleting USUARIO_RESTRICAO...
delete from USUARIO_RESTRICAO;
commit;
prompt Deleting USUARIO_GRUPO_RESTRICAO...
delete from USUARIO_GRUPO_RESTRICAO;
commit;
prompt Deleting USUARIO_GRUPO_EMPRESA...
delete from USUARIO_GRUPO_EMPRESA;
commit;
prompt Deleting USUARIO_EMPRESA...
delete from USUARIO_EMPRESA;
commit;
prompt Deleting USUARIO_ACESSO...
delete from USUARIO_ACESSO;
commit;
prompt Deleting UNIDADE_MEDIDA...
delete from UNIDADE_MEDIDA;
commit;
prompt Deleting TABELA_PRECO_ITEM...
delete from TABELA_PRECO_ITEM;
commit;
prompt Deleting PRODUTO_IMAGEM...
delete from PRODUTO_IMAGEM;
commit;
prompt Deleting PESQUISAS_RESPOSTAS...
delete from PESQUISAS_RESPOSTAS;
commit;
prompt Deleting PESQUISAS_PERGUNTAS_OPCOES...
delete from PESQUISAS_PERGUNTAS_OPCOES;
commit;
prompt Deleting PESQUISAS_PERGUNTAS...
delete from PESQUISAS_PERGUNTAS;
commit;
prompt Deleting ORCAMENTO_ITEM...
delete from ORCAMENTO_ITEM;
commit;
prompt Deleting JUSTIFICATIVAS...
delete from JUSTIFICATIVAS;
commit;
prompt Deleting ORCAMENTO...
delete from ORCAMENTO;
commit;
prompt Deleting FICHA_TECNICA_ITEM...
delete from FICHA_TECNICA_ITEM;
commit;
prompt Deleting FICHA_TECNICA...
delete from FICHA_TECNICA;
commit;
prompt Deleting PRODUTO...
delete from PRODUTO;
commit;
prompt Deleting PRODUTO_SUBGRUPO...
delete from PRODUTO_SUBGRUPO;
commit;
prompt Deleting PRODUTO_GRUPO...
delete from PRODUTO_GRUPO;
commit;
prompt Deleting ENT_FONE...
delete from ENT_FONE;
commit;
prompt Deleting ENTIDADE...
delete from ENTIDADE;
commit;
prompt Deleting EMPRESA_ATUACAO...
delete from EMPRESA_ATUACAO;
commit;
prompt Deleting CONFIG_EMPRESA...
delete from CONFIG_EMPRESA;
commit;
prompt Deleting TABELA_PRECO...
delete from TABELA_PRECO;
commit;
prompt Deleting COND_PAG_PARC...
delete from COND_PAG_PARC;
commit;
prompt Deleting COND_PAG...
delete from COND_PAG;
commit;
prompt Deleting FINANCEIRAS_PARCELAS...
delete from FINANCEIRAS_PARCELAS;
commit;
prompt Deleting FINANCEIRAS...
delete from FINANCEIRAS;
commit;
prompt Deleting CATEG_ENTIDADE...
delete from CATEG_ENTIDADE;
commit;
prompt Deleting CARTAO_CREDITO_PARAMETROS...
delete from CARTAO_CREDITO_PARAMETROS;
commit;
prompt Deleting CARTAO_CREDITO...
delete from CARTAO_CREDITO;
commit;
prompt Deleting FORMAS_PAGAMENTO...
delete from FORMAS_PAGAMENTO;
commit;
prompt Deleting TIPO_PAGAMENTO...
delete from TIPO_PAGAMENTO;
commit;
prompt Deleting EMPRESA...
delete from EMPRESA;
commit;
prompt Deleting CIDADE...
delete from CIDADE;
commit;
prompt Deleting UF...
delete from UF;
commit;
prompt Deleting USUARIO_GRUPO...
delete from USUARIO_GRUPO;
commit;
prompt Deleting USUARIO...
delete from USUARIO;
commit;
prompt Loading USUARIO...
insert into USUARIO (USUCOD, USUNOM, USUPASS, USUCAR, USUGRUCOD, USUSTA)
values (197, 'TESTE', 'TESTE', 'TESTE', null, 1);
insert into USUARIO (USUCOD, USUNOM, USUPASS, USUCAR, USUGRUCOD, USUSTA)
values (159, 'DANIEL', '1234', 'ADMINISTRADOR', null, 1);
insert into USUARIO (USUCOD, USUNOM, USUPASS, USUCAR, USUGRUCOD, USUSTA)
values (156, 'RAFA', '1234', 'PROGRAMADOR', null, 1);
insert into USUARIO (USUCOD, USUNOM, USUPASS, USUCAR, USUGRUCOD, USUSTA)
values (178, 'RODRIGO', 'ADC', 'TESTADOR', null, 1);
insert into USUARIO (USUCOD, USUNOM, USUPASS, USUCAR, USUGRUCOD, USUSTA)
values (29, 'RAFAEL', 'RM1928C', 'PROGRAMADOR', null, 1);
commit;
prompt 5 records loaded
prompt Loading USUARIO_GRUPO...
insert into USUARIO_GRUPO (USUGRUCOD, USUGRUDESC, USUCOD)
values (44, 'TESTE', 156);
insert into USUARIO_GRUPO (USUGRUCOD, USUGRUDESC, USUCOD)
values (26, 'TOTAL', 156);
commit;
prompt 2 records loaded
prompt Loading UF...
insert into UF (UFCOD, UFNOM, UFCODPAIS, UFABREV)
values (41, 'SANTA CATARINA', '123', 'SC');
insert into UF (UFCOD, UFNOM, UFCODPAIS, UFABREV)
values (5, 'SAO PAULO', '5957', 'SP');
insert into UF (UFCOD, UFNOM, UFCODPAIS, UFABREV)
values (104, 'teste', '212', 'ss');
insert into UF (UFCOD, UFNOM, UFCODPAIS, UFABREV)
values (47, 'RIO DE JANEIRO', '122', 'RJ');
insert into UF (UFCOD, UFNOM, UFCODPAIS, UFABREV)
values (105, 'teste2', '2212', 'so');
insert into UF (UFCOD, UFNOM, UFCODPAIS, UFABREV)
values (65, 'PARANA', '1235', 'PR');
insert into UF (UFCOD, UFNOM, UFCODPAIS, UFABREV)
values (67, 'RIO GRANDE DO SUL', '1111', 'RS');
insert into UF (UFCOD, UFNOM, UFCODPAIS, UFABREV)
values (68, 'MATO GROSSO DO SUL', '111', 'MS');
commit;
prompt 8 records loaded
prompt Loading CIDADE...
insert into CIDADE (CIDCOD, CIDNOM, CIDNAC, CIDIBG, CIDUFCOD)
values (81, 'SAO PAULO', 32, 11, 5);
insert into CIDADE (CIDCOD, CIDNOM, CIDNAC, CIDIBG, CIDUFCOD)
values (3, 'MIRASSOL', 30300, 222, 5);
insert into CIDADE (CIDCOD, CIDNOM, CIDNAC, CIDIBG, CIDUFCOD)
values (123, 'URUPES', 1231412, 12312312, 5);
insert into CIDADE (CIDCOD, CIDNOM, CIDNAC, CIDIBG, CIDUFCOD)
values (64, 'RIO DE JANEIRO', 30300, 37, 47);
insert into CIDADE (CIDCOD, CIDNOM, CIDNAC, CIDIBG, CIDUFCOD)
values (41, 'SAO JOSE DO RIO PRETO', 30000, 32, 5);
insert into CIDADE (CIDCOD, CIDNOM, CIDNAC, CIDIBG, CIDUFCOD)
values (42, 'MACAUBAL', 3001, 35, 5);
insert into CIDADE (CIDCOD, CIDNOM, CIDNAC, CIDIBG, CIDUFCOD)
values (85, 'SAO JOAO DAS DUAS PONTES', 1234, 32, 41);
insert into CIDADE (CIDCOD, CIDNOM, CIDNAC, CIDIBG, CIDUFCOD)
values (25, 'NHANDEARA', 30300, 3232, 5);
insert into CIDADE (CIDCOD, CIDNOM, CIDNAC, CIDIBG, CIDUFCOD)
values (86, 'CUIABA', 1, 1, 65);
commit;
prompt 9 records loaded
prompt Loading EMPRESA...
insert into EMPRESA (EMPCOD, EMPNOM, EMPNOMFAN, EMPDATCAD, EMPSIG, EMPCNP, EMPIE, EMPEND, EMPBAI, EMPENDCOM, EMPENDNUM, EMPCEP, EMPTEL, CIDCOD, EMPEMA, EMPHOM, EMPINDVALMIN, USUCOD, MSG1)
values (4, 'ADM CITRINO INFORMATICA LTDA ME', 'ADM CITRINO', to_date('06-12-2012', 'dd-mm-yyyy'), 'ADM', '00689700000135', '111111111', 'RUA JOSE INACIO DE PADUA', 'TARRAF', 'SALA 1', '33061', '15130000', '1732425757', 3, 'RAFAEL@TENCO.COM.BR', 'WWW.ADMCITRINO.COM.BR', 1.75, null, '1');
insert into EMPRESA (EMPCOD, EMPNOM, EMPNOMFAN, EMPDATCAD, EMPSIG, EMPCNP, EMPIE, EMPEND, EMPBAI, EMPENDCOM, EMPENDNUM, EMPCEP, EMPTEL, CIDCOD, EMPEMA, EMPHOM, EMPINDVALMIN, USUCOD, MSG1)
values (5, 'TENCO LTDA', 'TENCO', to_date('07-12-2012', 'dd-mm-yyyy'), 'TENCO', '22222222222222', '33333333333333', 'RUA LIBERO BADARO', 'CENTRO', 'CASA', '105', '15190000', '30300', 3, 'RAFAEL@TENCO.COM.BR', null, 1.75, null, 'gravando em todo mundo');
commit;
prompt 2 records loaded
prompt Loading TIPO_PAGAMENTO...
insert into TIPO_PAGAMENTO (TIPPAGNUM, TIPPAGDES, EMPCOD, USUCOD)
values (25, 'VENDA A VISTA', 4, 156);
insert into TIPO_PAGAMENTO (TIPPAGNUM, TIPPAGDES, EMPCOD, USUCOD)
values (1, 'CARTAO', 4, 156);
insert into TIPO_PAGAMENTO (TIPPAGNUM, TIPPAGDES, EMPCOD, USUCOD)
values (2, 'TEF', 4, 156);
insert into TIPO_PAGAMENTO (TIPPAGNUM, TIPPAGDES, EMPCOD, USUCOD)
values (3, 'Venda Prazo', 4, 156);
insert into TIPO_PAGAMENTO (TIPPAGNUM, TIPPAGDES, EMPCOD, USUCOD)
values (4, 'Outras', 4, 156);
commit;
prompt 5 records loaded
prompt Loading FORMAS_PAGAMENTO...
insert into FORMAS_PAGAMENTO (EMPCOD, FORPAGNUM, FORPAGDES, FORPAGVALMAX, FORPAGVEN, FORPAGTIP, FORPAGMAXPAR, USUCOD)
values (5, 62, 'EMPRESA 5', null, 'V', 1, null, 156);
insert into FORMAS_PAGAMENTO (EMPCOD, FORPAGNUM, FORPAGDES, FORPAGVALMAX, FORPAGVEN, FORPAGTIP, FORPAGMAXPAR, USUCOD)
values (4, 43, 'FINANCIAMENTO', null, 'P', 4, 18, 156);
insert into FORMAS_PAGAMENTO (EMPCOD, FORPAGNUM, FORPAGDES, FORPAGVALMAX, FORPAGVEN, FORPAGTIP, FORPAGMAXPAR, USUCOD)
values (4, 44, 'CARTAO', null, 'P', 1, 12, 156);
insert into FORMAS_PAGAMENTO (EMPCOD, FORPAGNUM, FORPAGDES, FORPAGVALMAX, FORPAGVEN, FORPAGTIP, FORPAGMAXPAR, USUCOD)
values (4, 45, 'DINHEIRO', null, 'V', 25, null, 156);
commit;
prompt 4 records loaded
prompt Loading CARTAO_CREDITO...
insert into CARTAO_CREDITO (EMPCOD, USUCOD, CARCRECOD, CARCRERED, CARCREDES, CARCRETIP, CARCREREP, CARCREFEC, CARCRECC, FORNUMPAG, CARCRENUMMAXPAR, CARCREPAR)
values (4, 156, 41, 'VISA', 'VISA 12X - SEM JUROS', 'C', 30, 'M', 0, 44, 12, 1);
commit;
prompt 1 records loaded
prompt Loading CARTAO_CREDITO_PARAMETROS...
insert into CARTAO_CREDITO_PARAMETROS (EMPCOD, CARCRECOD, CARCREPARNUM, CARCREPARTAX)
values (4, 41, 1, 1);
insert into CARTAO_CREDITO_PARAMETROS (EMPCOD, CARCRECOD, CARCREPARNUM, CARCREPARTAX)
values (4, 41, 2, 2);
insert into CARTAO_CREDITO_PARAMETROS (EMPCOD, CARCRECOD, CARCREPARNUM, CARCREPARTAX)
values (4, 41, 3, 3);
insert into CARTAO_CREDITO_PARAMETROS (EMPCOD, CARCRECOD, CARCREPARNUM, CARCREPARTAX)
values (4, 41, 4, 4);
insert into CARTAO_CREDITO_PARAMETROS (EMPCOD, CARCRECOD, CARCREPARNUM, CARCREPARTAX)
values (4, 41, 5, 5);
insert into CARTAO_CREDITO_PARAMETROS (EMPCOD, CARCRECOD, CARCREPARNUM, CARCREPARTAX)
values (4, 41, 6, 6);
insert into CARTAO_CREDITO_PARAMETROS (EMPCOD, CARCRECOD, CARCREPARNUM, CARCREPARTAX)
values (4, 41, 7, 7);
insert into CARTAO_CREDITO_PARAMETROS (EMPCOD, CARCRECOD, CARCREPARNUM, CARCREPARTAX)
values (4, 41, 8, 8);
insert into CARTAO_CREDITO_PARAMETROS (EMPCOD, CARCRECOD, CARCREPARNUM, CARCREPARTAX)
values (4, 41, 9, 9);
insert into CARTAO_CREDITO_PARAMETROS (EMPCOD, CARCRECOD, CARCREPARNUM, CARCREPARTAX)
values (4, 41, 10, 10);
insert into CARTAO_CREDITO_PARAMETROS (EMPCOD, CARCRECOD, CARCREPARNUM, CARCREPARTAX)
values (4, 41, 11, 11);
insert into CARTAO_CREDITO_PARAMETROS (EMPCOD, CARCRECOD, CARCREPARNUM, CARCREPARTAX)
values (4, 41, 12, 12);
commit;
prompt 12 records loaded
prompt Loading CATEG_ENTIDADE...
insert into CATEG_ENTIDADE (CATENTCODESTR, CATENTDESC, USUCOD, CATENTCLA, EMPCOD)
values ('2', 'FORNECEDORES', 156, 'FOR', 4);
insert into CATEG_ENTIDADE (CATENTCODESTR, CATENTDESC, USUCOD, CATENTCLA, EMPCOD)
values ('7', 'FORNECEDOR', 156, 'FOR', 5);
insert into CATEG_ENTIDADE (CATENTCODESTR, CATENTDESC, USUCOD, CATENTCLA, EMPCOD)
values ('5', 'CLIENTE', 156, 'CLI', 5);
insert into CATEG_ENTIDADE (CATENTCODESTR, CATENTDESC, USUCOD, CATENTCLA, EMPCOD)
values ('6', 'REPRESENTANTE', 156, 'REP', 5);
insert into CATEG_ENTIDADE (CATENTCODESTR, CATENTDESC, USUCOD, CATENTCLA, EMPCOD)
values ('1', 'CLIENTES', 8, 'CLI', 4);
insert into CATEG_ENTIDADE (CATENTCODESTR, CATENTDESC, USUCOD, CATENTCLA, EMPCOD)
values ('3', 'REPRESENTANTES', 156, 'REP', 4);
commit;
prompt 6 records loaded
prompt Loading FINANCEIRAS...
insert into FINANCEIRAS (FINCOD, FINNOM, FINTAXABE, USUCOD, EMPCOD)
values (1, 'SANTANDER', 0, 156, 4);
insert into FINANCEIRAS (FINCOD, FINNOM, FINTAXABE, USUCOD, EMPCOD)
values (2, 'BMG', 0, 156, 4);
commit;
prompt 2 records loaded
prompt Loading FINANCEIRAS_PARCELAS...
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (2, 1, 30, 1, 156, 4, 10);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (2, 2, 30, 2, 156, 4, 10);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (2, 3, 30, 3, 156, 4, 10);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (2, 4, 30, 4, 156, 4, 10);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (2, 5, 30, 5, 156, 4, 10);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (2, 6, 30, 6, 156, 4, 10);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (2, 7, 30, 7, 156, 4, 10);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (2, 8, 30, 8, 156, 4, 10);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (2, 9, 30, 9, 156, 4, 10);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (2, 10, 30, 10, 156, 4, 10);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (1, 1, 30, 1, 156, 4, 18);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (1, 2, 30, 2, 156, 4, 18);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (1, 3, 30, 3, 156, 4, 18);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (1, 4, 30, 4, 156, 4, 18);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (1, 5, 30, 5, 156, 4, 18);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (1, 6, 30, 6, 156, 4, 18);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (1, 7, 30, 7, 156, 4, 18);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (1, 8, 30, 8, 156, 4, 18);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (1, 9, 30, 9, 156, 4, 18);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (1, 10, 30, 10, 156, 4, 18);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (1, 11, 30, 11, 156, 4, 18);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (1, 12, 30, 12, 156, 4, 18);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (1, 13, 30, 13, 156, 4, 18);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (1, 14, 30, 14, 156, 4, 18);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (1, 15, 30, 15, 156, 4, 18);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (1, 16, 30, 16, 156, 4, 18);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (1, 17, 30, 17, 156, 4, 18);
insert into FINANCEIRAS_PARCELAS (FINCOD, FINPARNUM, FINPARCAR, FINPARIND, USUCOD, EMPCOD, FINPARTOTPAR)
values (1, 18, 30, 18, 156, 4, 18);
commit;
prompt 28 records loaded
prompt Loading COND_PAG...
insert into COND_PAG (CONPAGCOD, CONPAGDEN, CONPAGQTDPAR, CONPAGDIAPAR, CONPAGDIAPRIPAR, USUCOD, FINCOD, FINPARCAR, FINPARNUM, FORPAGNUM, EMPCOD)
values (4, '0+9', 9, 30, 30, 156, 1, 30, 18, 43, 4);
insert into COND_PAG (CONPAGCOD, CONPAGDEN, CONPAGQTDPAR, CONPAGDIAPAR, CONPAGDIAPRIPAR, USUCOD, FINCOD, FINPARCAR, FINPARNUM, FORPAGNUM, EMPCOD)
values (6, '0+5', 5, 30, 30, 156, 2, 30, 10, null, 5);
insert into COND_PAG (CONPAGCOD, CONPAGDEN, CONPAGQTDPAR, CONPAGDIAPAR, CONPAGDIAPRIPAR, USUCOD, FINCOD, FINPARCAR, FINPARNUM, FORPAGNUM, EMPCOD)
values (7, '0+6', 6, 30, 30, 156, null, null, null, null, 5);
insert into COND_PAG (CONPAGCOD, CONPAGDEN, CONPAGQTDPAR, CONPAGDIAPAR, CONPAGDIAPRIPAR, USUCOD, FINCOD, FINPARCAR, FINPARNUM, FORPAGNUM, EMPCOD)
values (8, '0+7', 7, 30, 30, 156, null, null, null, null, 5);
insert into COND_PAG (CONPAGCOD, CONPAGDEN, CONPAGQTDPAR, CONPAGDIAPAR, CONPAGDIAPRIPAR, USUCOD, FINCOD, FINPARCAR, FINPARNUM, FORPAGNUM, EMPCOD)
values (1, '0+5', 5, 30, 30, 156, 1, 30, 18, 43, 4);
insert into COND_PAG (CONPAGCOD, CONPAGDEN, CONPAGQTDPAR, CONPAGDIAPAR, CONPAGDIAPRIPAR, USUCOD, FINCOD, FINPARCAR, FINPARNUM, FORPAGNUM, EMPCOD)
values (2, '0+5', 5, 30, 30, 156, 2, 30, 10, 43, 4);
commit;
prompt 6 records loaded
prompt Loading COND_PAG_PARC...
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (6, 1, 30);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (6, 2, 60);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (6, 3, 90);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (6, 4, 120);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (6, 5, 150);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (7, 1, 30);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (7, 2, 60);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (4, 1, 30);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (4, 2, 60);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (4, 3, 90);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (4, 4, 120);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (4, 5, 150);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (4, 6, 180);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (4, 7, 210);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (4, 8, 240);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (4, 9, 270);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (7, 3, 90);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (7, 4, 120);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (7, 5, 150);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (7, 6, 180);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (8, 1, 30);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (8, 2, 60);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (8, 3, 90);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (8, 4, 120);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (8, 5, 150);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (8, 6, 180);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (8, 7, 210);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (1, 1, 30);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (2, 2, 60);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (1, 2, 60);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (1, 3, 90);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (1, 4, 120);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (1, 5, 150);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (2, 1, 31);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (2, 3, 90);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (2, 4, 120);
insert into COND_PAG_PARC (CONPAGCOD, CONPAGPARSEQ, CONPAGPARDIA)
values (2, 5, 150);
commit;
prompt 37 records loaded
prompt Loading TABELA_PRECO...
insert into TABELA_PRECO (EMPCOD, TABPRECOD, TABPREDEN, USUCOD, TABPREINDVEN)
values (4, 1, 'PRECO 1', 156, 2);
insert into TABELA_PRECO (EMPCOD, TABPRECOD, TABPREDEN, USUCOD, TABPREINDVEN)
values (4, 21, 'TESTE', 156, 0);
insert into TABELA_PRECO (EMPCOD, TABPRECOD, TABPREDEN, USUCOD, TABPREINDVEN)
values (4, 22, 'TESTE', 156, 0);
insert into TABELA_PRECO (EMPCOD, TABPRECOD, TABPREDEN, USUCOD, TABPREINDVEN)
values (4, 41, 'FILIAL CEDRAL', 156, 3);
insert into TABELA_PRECO (EMPCOD, TABPRECOD, TABPREDEN, USUCOD, TABPREINDVEN)
values (4, 10, 'PRECO 2', 156, 3);
commit;
prompt 5 records loaded
prompt Loading CONFIG_EMPRESA...
insert into CONFIG_EMPRESA (EMPCOD, ORC_TABPRE, CONPAGCOD)
values (4, 10, 87);
insert into CONFIG_EMPRESA (EMPCOD, ORC_TABPRE, CONPAGCOD)
values (5, null, null);
insert into CONFIG_EMPRESA (EMPCOD, ORC_TABPRE, CONPAGCOD)
values (6, null, null);
insert into CONFIG_EMPRESA (EMPCOD, ORC_TABPRE, CONPAGCOD)
values (105, null, null);
commit;
prompt 4 records loaded
prompt Loading EMPRESA_ATUACAO...
insert into EMPRESA_ATUACAO (EMPCOD, CIDCOD, USUCOD)
values (4, 41, 156);
insert into EMPRESA_ATUACAO (EMPCOD, CIDCOD, USUCOD)
values (5, 81, 156);
insert into EMPRESA_ATUACAO (EMPCOD, CIDCOD, USUCOD)
values (4, 3, 156);
insert into EMPRESA_ATUACAO (EMPCOD, CIDCOD, USUCOD)
values (4, 123, 156);
insert into EMPRESA_ATUACAO (EMPCOD, CIDCOD, USUCOD)
values (5, 3, 156);
insert into EMPRESA_ATUACAO (EMPCOD, CIDCOD, USUCOD)
values (5, 64, 156);
insert into EMPRESA_ATUACAO (EMPCOD, CIDCOD, USUCOD)
values (5, 25, 156);
commit;
prompt 7 records loaded
prompt Loading ENTIDADE...
insert into ENTIDADE (ENTCOD, ENTNOM, ENTNOMFAN, ENTEND, ENTNUM, ENTBAI, ENTCEP, CIDCOD, ENTCNPJCPF, ENTINSEST, ENTDATCAD, ENTHOMPAG, USUCOD, CATENTCODESTR, ENTNOMMAE, ENTNOMPAI, ENTRG, ENTEMA, ENTLOCTRA, ENTENDTRA, ENTATI, ENTPRO, ENTDATNAS, ENTTIPPES, ENTCON, ENTENDCOB, ENTNUMCOB, ENTBAICOB, ENTCEPCOB, CIDCODCOB, ENTTEXLIV, ENTLIMCRE, ENTDATCONCRE, ENTGER, ENTBLO, ENTCOMPRA, ENTESTCIV, ENTSALTRA, ENTTEMTRA, ENTNOMCON, ENTCPFCON, ENTRGCON, ENTLOCTRACON, ENTTEMTRACON, ENTSALCON, ENTRESCONCRE, ENTCODVEN, ENTPRCPAG, ENTENDCOM, CFOCOD, ENTREPCOM, ENTCODREP, EMPCOD)
values (300, 'RAFA', 'RAA', 'RA', 'A', 'A', ' ', 25, ' ', ' ', to_date('04-02-2013', 'dd-mm-yyyy'), ' ', 156, '3', ' ', ' ', ' ', ' ', ' ', ' ', 1, ' ', null, ' ', 'CONTATO', ' ', ' ', ' ', ' ', null, 'OBSERVACAO', 1, null, ' ', 2, 2, null, 0, ' ', ' ', ' ', ' ', ' ', ' ', 0, null, null, null, null, null, null, null, 4);
insert into ENTIDADE (ENTCOD, ENTNOM, ENTNOMFAN, ENTEND, ENTNUM, ENTBAI, ENTCEP, CIDCOD, ENTCNPJCPF, ENTINSEST, ENTDATCAD, ENTHOMPAG, USUCOD, CATENTCODESTR, ENTNOMMAE, ENTNOMPAI, ENTRG, ENTEMA, ENTLOCTRA, ENTENDTRA, ENTATI, ENTPRO, ENTDATNAS, ENTTIPPES, ENTCON, ENTENDCOB, ENTNUMCOB, ENTBAICOB, ENTCEPCOB, CIDCODCOB, ENTTEXLIV, ENTLIMCRE, ENTDATCONCRE, ENTGER, ENTBLO, ENTCOMPRA, ENTESTCIV, ENTSALTRA, ENTTEMTRA, ENTNOMCON, ENTCPFCON, ENTRGCON, ENTLOCTRACON, ENTTEMTRACON, ENTSALCON, ENTRESCONCRE, ENTCODVEN, ENTPRCPAG, ENTENDCOM, CFOCOD, ENTREPCOM, ENTCODREP, EMPCOD)
values (276, 'RAFAEL MARQUES CRIADO', 'RAFAEL', 'RUA LIBERO BADARO', '105', 'CENTRO', '15190000', 25, '37059641866', ' ', to_date('15-01-2013', 'dd-mm-yyyy'), 'www.citrino.com.br', 156, '2', ' ', ' ', ' ', 'rafael.marquescriado@outlook.com', ' ', ' ', 1, ' ', null, ' ', 'CONTATO', ' ', ' ', ' ', ' ', null, 'OBSERVACAO', 1, null, ' ', 2, 2, null, 0, ' ', ' ', ' ', ' ', ' ', ' ', 0, null, null, null, null, null, null, null, 4);
insert into ENTIDADE (ENTCOD, ENTNOM, ENTNOMFAN, ENTEND, ENTNUM, ENTBAI, ENTCEP, CIDCOD, ENTCNPJCPF, ENTINSEST, ENTDATCAD, ENTHOMPAG, USUCOD, CATENTCODESTR, ENTNOMMAE, ENTNOMPAI, ENTRG, ENTEMA, ENTLOCTRA, ENTENDTRA, ENTATI, ENTPRO, ENTDATNAS, ENTTIPPES, ENTCON, ENTENDCOB, ENTNUMCOB, ENTBAICOB, ENTCEPCOB, CIDCODCOB, ENTTEXLIV, ENTLIMCRE, ENTDATCONCRE, ENTGER, ENTBLO, ENTCOMPRA, ENTESTCIV, ENTSALTRA, ENTTEMTRA, ENTNOMCON, ENTCPFCON, ENTRGCON, ENTLOCTRACON, ENTTEMTRACON, ENTSALCON, ENTRESCONCRE, ENTCODVEN, ENTPRCPAG, ENTENDCOM, CFOCOD, ENTREPCOM, ENTCODREP, EMPCOD)
values (277, 'WALLMART', 'WALLMART', 'AVENIDA JOSE MONIA', '4501', 'NOVA REDENTORA', '15085350', 41, ' ', ' ', to_date('15-01-2013', 'dd-mm-yyyy'), ' ', 156, '2', ' ', ' ', ' ', ' ', ' ', ' ', 1, ' ', null, ' ', 'CONTATO', ' ', ' ', ' ', ' ', null, 'OBSERVACAO', 1, null, ' ', 2, 2, null, 0, ' ', ' ', ' ', ' ', ' ', ' ', 0, null, null, null, null, null, null, null, 4);
insert into ENTIDADE (ENTCOD, ENTNOM, ENTNOMFAN, ENTEND, ENTNUM, ENTBAI, ENTCEP, CIDCOD, ENTCNPJCPF, ENTINSEST, ENTDATCAD, ENTHOMPAG, USUCOD, CATENTCODESTR, ENTNOMMAE, ENTNOMPAI, ENTRG, ENTEMA, ENTLOCTRA, ENTENDTRA, ENTATI, ENTPRO, ENTDATNAS, ENTTIPPES, ENTCON, ENTENDCOB, ENTNUMCOB, ENTBAICOB, ENTCEPCOB, CIDCODCOB, ENTTEXLIV, ENTLIMCRE, ENTDATCONCRE, ENTGER, ENTBLO, ENTCOMPRA, ENTESTCIV, ENTSALTRA, ENTTEMTRA, ENTNOMCON, ENTCPFCON, ENTRGCON, ENTLOCTRACON, ENTTEMTRACON, ENTSALCON, ENTRESCONCRE, ENTCODVEN, ENTPRCPAG, ENTENDCOM, CFOCOD, ENTREPCOM, ENTCODREP, EMPCOD)
values (278, 'CITRINO', 'CITRINO', 'RUA JOSE INACIO DE PADUA', '3361', 'PORTAL', '15190000', 3, ' ', ' ', to_date('15-01-2013', 'dd-mm-yyyy'), ' ', 156, '3', ' ', ' ', ' ', ' ', ' ', ' ', 1, ' ', null, ' ', 'CONTATO', ' ', ' ', ' ', ' ', null, 'OBSERVACAO', 1, null, ' ', 2, 2, null, 0, ' ', ' ', ' ', ' ', ' ', ' ', 0, null, null, null, null, null, null, null, 4);
insert into ENTIDADE (ENTCOD, ENTNOM, ENTNOMFAN, ENTEND, ENTNUM, ENTBAI, ENTCEP, CIDCOD, ENTCNPJCPF, ENTINSEST, ENTDATCAD, ENTHOMPAG, USUCOD, CATENTCODESTR, ENTNOMMAE, ENTNOMPAI, ENTRG, ENTEMA, ENTLOCTRA, ENTENDTRA, ENTATI, ENTPRO, ENTDATNAS, ENTTIPPES, ENTCON, ENTENDCOB, ENTNUMCOB, ENTBAICOB, ENTCEPCOB, CIDCODCOB, ENTTEXLIV, ENTLIMCRE, ENTDATCONCRE, ENTGER, ENTBLO, ENTCOMPRA, ENTESTCIV, ENTSALTRA, ENTTEMTRA, ENTNOMCON, ENTCPFCON, ENTRGCON, ENTLOCTRACON, ENTTEMTRACON, ENTSALCON, ENTRESCONCRE, ENTCODVEN, ENTPRCPAG, ENTENDCOM, CFOCOD, ENTREPCOM, ENTCODREP, EMPCOD)
values (279, 'RODRIGO TOFOLLI', 'RODRIGO', 'RUA DOS FLEURY', '3365', 'NS APARECIDA', '15130000', 3, ' ', ' ', to_date('15-01-2013', 'dd-mm-yyyy'), ' ', 156, '1', ' ', ' ', ' ', ' ', ' ', ' ', 1, ' ', null, ' ', 'CONTATO', ' ', ' ', ' ', ' ', null, 'OBSERVACAO', 1, null, ' ', 2, 2, null, 0, ' ', ' ', ' ', ' ', ' ', ' ', 0, null, null, null, null, null, null, null, 4);
insert into ENTIDADE (ENTCOD, ENTNOM, ENTNOMFAN, ENTEND, ENTNUM, ENTBAI, ENTCEP, CIDCOD, ENTCNPJCPF, ENTINSEST, ENTDATCAD, ENTHOMPAG, USUCOD, CATENTCODESTR, ENTNOMMAE, ENTNOMPAI, ENTRG, ENTEMA, ENTLOCTRA, ENTENDTRA, ENTATI, ENTPRO, ENTDATNAS, ENTTIPPES, ENTCON, ENTENDCOB, ENTNUMCOB, ENTBAICOB, ENTCEPCOB, CIDCODCOB, ENTTEXLIV, ENTLIMCRE, ENTDATCONCRE, ENTGER, ENTBLO, ENTCOMPRA, ENTESTCIV, ENTSALTRA, ENTTEMTRA, ENTNOMCON, ENTCPFCON, ENTRGCON, ENTLOCTRACON, ENTTEMTRACON, ENTSALCON, ENTRESCONCRE, ENTCODVEN, ENTPRCPAG, ENTENDCOM, CFOCOD, ENTREPCOM, ENTCODREP, EMPCOD)
values (355, 'ANNA', 'ANNA', 'RUA CARMO BUISSA ', '805', 'CENTRO', '15130000', 42, ' ', ' ', to_date('19-03-2013', 'dd-mm-yyyy'), ' ', 156, '2', ' ', ' ', ' ', 'ANNA.LUARA.ALARCON@GMAIL.COM', ' ', ' ', 1, ' ', null, ' ', 'CONTATO', ' ', ' ', ' ', ' ', null, 'OBSERVACAO', 1, null, ' ', 2, 2, null, 0, ' ', ' ', ' ', ' ', ' ', ' ', 0, null, null, null, null, null, null, null, 5);
insert into ENTIDADE (ENTCOD, ENTNOM, ENTNOMFAN, ENTEND, ENTNUM, ENTBAI, ENTCEP, CIDCOD, ENTCNPJCPF, ENTINSEST, ENTDATCAD, ENTHOMPAG, USUCOD, CATENTCODESTR, ENTNOMMAE, ENTNOMPAI, ENTRG, ENTEMA, ENTLOCTRA, ENTENDTRA, ENTATI, ENTPRO, ENTDATNAS, ENTTIPPES, ENTCON, ENTENDCOB, ENTNUMCOB, ENTBAICOB, ENTCEPCOB, CIDCODCOB, ENTTEXLIV, ENTLIMCRE, ENTDATCONCRE, ENTGER, ENTBLO, ENTCOMPRA, ENTESTCIV, ENTSALTRA, ENTTEMTRA, ENTNOMCON, ENTCPFCON, ENTRGCON, ENTLOCTRACON, ENTTEMTRACON, ENTSALCON, ENTRESCONCRE, ENTCODVEN, ENTPRCPAG, ENTENDCOM, CFOCOD, ENTREPCOM, ENTCODREP, EMPCOD)
values (280, 'FABIO', ' ', 'RUA BRAS CABRAL DE MEDEIROS', '3058', 'SANTA CASA', ' ', 3, ' ', ' ', to_date('16-01-2013', 'dd-mm-yyyy'), ' ', 156, '1', ' ', ' ', ' ', ' ', ' ', ' ', 1, ' ', null, ' ', 'CONTATO', ' ', ' ', ' ', ' ', null, 'OBSERVACAO', 1, null, ' ', 2, 2, null, 0, ' ', ' ', ' ', ' ', ' ', ' ', 0, null, null, null, null, null, null, null, 4);
commit;
prompt 7 records loaded
prompt Loading ENT_FONE...
insert into ENT_FONE (ENTCOD, ENTFONNUM, ENTFONDESC, ENTFONTIP, USUCOD)
values (300, '000', 'COMERCIAL', 'COMERCIAL', 156);
insert into ENT_FONE (ENTCOD, ENTFONNUM, ENTFONDESC, ENTFONTIP, USUCOD)
values (300, '0', 'CELULAR', 'CELULAR', 156);
insert into ENT_FONE (ENTCOD, ENTFONNUM, ENTFONDESC, ENTFONTIP, USUCOD)
values (300, '00', 'RESIDENCIAL', 'RESIDENCIAL', 156);
commit;
prompt 3 records loaded
prompt Loading PRODUTO_GRUPO...
insert into PRODUTO_GRUPO (EMPCOD, PROGRUCOD, PROGRUDEN, USUCOD)
values (4, 163, 'ACESSORIOS', 156);
insert into PRODUTO_GRUPO (EMPCOD, PROGRUCOD, PROGRUDEN, USUCOD)
values (4, 143, 'SPA', 156);
insert into PRODUTO_GRUPO (EMPCOD, PROGRUCOD, PROGRUDEN, USUCOD)
values (4, 146, 'OFUROS', 156);
insert into PRODUTO_GRUPO (EMPCOD, PROGRUCOD, PROGRUDEN, USUCOD)
values (4, 147, 'HIDROMASSAGENS', 156);
commit;
prompt 4 records loaded
prompt Loading PRODUTO_SUBGRUPO...
insert into PRODUTO_SUBGRUPO (EMPCOD, PROSUBGRUCOD, PROSUBGRUDEN, PROGRUCOD, USUCOD)
values (4, 61, 'ACESSORIOS P/ BANHEIRAS', 163, 156);
insert into PRODUTO_SUBGRUPO (EMPCOD, PROSUBGRUCOD, PROSUBGRUDEN, PROGRUCOD, USUCOD)
values (4, 52, 'TAYLOR', 143, 156);
insert into PRODUTO_SUBGRUPO (EMPCOD, PROSUBGRUCOD, PROSUBGRUDEN, PROGRUCOD, USUCOD)
values (4, 44, 'ANGELINA', 147, 156);
insert into PRODUTO_SUBGRUPO (EMPCOD, PROSUBGRUCOD, PROSUBGRUDEN, PROGRUCOD, USUCOD)
values (4, 50, 'MARYLIN', 143, 156);
insert into PRODUTO_SUBGRUPO (EMPCOD, PROSUBGRUCOD, PROSUBGRUDEN, PROGRUCOD, USUCOD)
values (4, 47, 'BARDOT', 147, 156);
insert into PRODUTO_SUBGRUPO (EMPCOD, PROSUBGRUCOD, PROSUBGRUDEN, PROGRUCOD, USUCOD)
values (4, 49, 'CELINE', 147, 156);
commit;
prompt 6 records loaded
prompt Loading PRODUTO...
insert into PRODUTO (EMPCOD, PROCOD, PRODES, PROCODBAR, UNIMEDCOD, PRODATCAD, PROCONEST, USUCOD, PROGRUCOD, PROSUBGRUCOD, PRONCM, PROLAR, PROALT, PROCOM, PROPESLIQ, PROPESBRU, PROTIP, PROCOR, PRODESALT, PROMAT, PROCAR1, PROCAR2, PROCAR3, PROMAR, PROCODALT, PROVALCUS)
values (4, 71, 'AG180', '3333', 'UN', to_date('31-01-2013', 'dd-mm-yyyy'), 'S', 156, 147, 44, '3333.33.33', 180, 80, 100, null, null, 'A', 'BRANCO', null, 'GEL COAT', '1', 'PE', '110', null, null, 1000);
insert into PRODUTO (EMPCOD, PROCOD, PRODES, PROCODBAR, UNIMEDCOD, PRODATCAD, PROCONEST, USUCOD, PROGRUCOD, PROSUBGRUCOD, PRONCM, PROLAR, PROALT, PROCOM, PROPESLIQ, PROPESBRU, PROTIP, PROCOR, PRODESALT, PROMAT, PROCAR1, PROCAR2, PROCAR3, PROMAR, PROCODALT, PROVALCUS)
values (4, 70, 'AG150', '1234', 'UN', to_date('30-01-2013', 'dd-mm-yyyy'), 'S', 156, 147, 44, '1111.11.11', 150, 90, 100, null, null, 'B', 'BEGE', null, 'RESINA', '2', 'PD', '220', null, null, 5000);
insert into PRODUTO (EMPCOD, PROCOD, PRODES, PROCODBAR, UNIMEDCOD, PRODATCAD, PROCONEST, USUCOD, PROGRUCOD, PROSUBGRUCOD, PRONCM, PROLAR, PROALT, PROCOM, PROPESLIQ, PROPESBRU, PROTIP, PROCOR, PRODESALT, PROMAT, PROCAR1, PROCAR2, PROCAR3, PROMAR, PROCODALT, PROVALCUS)
values (4, 81, 'KIT 1', '12313', 'UN', to_date('06-02-2013', 'dd-mm-yyyy'), 'S', 156, 163, 61, '1231', 130, 130, 130, null, null, 'F', null, null, null, null, null, null, null, null, 7000);
insert into PRODUTO (EMPCOD, PROCOD, PRODES, PROCODBAR, UNIMEDCOD, PRODATCAD, PROCONEST, USUCOD, PROGRUCOD, PROSUBGRUCOD, PRONCM, PROLAR, PROALT, PROCOM, PROPESLIQ, PROPESBRU, PROTIP, PROCOR, PRODESALT, PROMAT, PROCAR1, PROCAR2, PROCAR3, PROMAR, PROCODALT, PROVALCUS)
values (4, 73, 'AT', '12312', 'UN', to_date('31-01-2013', 'dd-mm-yyyy'), 'S', 156, 147, 44, '3333.33.33', 180, 90, 100, null, null, 'A', 'GELO', null, 'RESINA', '2', 'BD', '220', null, null, 5500);
insert into PRODUTO (EMPCOD, PROCOD, PRODES, PROCODBAR, UNIMEDCOD, PRODATCAD, PROCONEST, USUCOD, PROGRUCOD, PROSUBGRUCOD, PRONCM, PROLAR, PROALT, PROCOM, PROPESLIQ, PROPESBRU, PROTIP, PROCOR, PRODESALT, PROMAT, PROCAR1, PROCAR2, PROCAR3, PROMAR, PROCODALT, PROVALCUS)
values (5, 101, 'TESTEA', null, null, to_date('11-02-2013', 'dd-mm-yyyy'), 'S', 156, null, null, null, null, null, null, null, null, 'A', null, null, null, null, null, null, null, null, 1000);
commit;
prompt 5 records loaded
prompt Loading FICHA_TECNICA...
prompt Table is empty
prompt Loading FICHA_TECNICA_ITEM...
prompt Table is empty
prompt Loading ORCAMENTO...
insert into ORCAMENTO (EMPCOD, ORCCOD, ORCDATCAD, ORCDAT, ENTCOD, ORCDATVAL, ORCPRAENT, CONPAGCOD, ORCPERDES1, ORCPERDES2, ORCPERDES3, ORCVALFRE, ORCVALTOT, USUCOD, ORCOBS, ORCSTA, ORCVALADI, ORCPREVEN, ORCVEN, ORCINCFINADC, ORCINCFINFRE, ORCINCFINTXAB, ORCVALTXAB, ORCINDPERFIN, FORPAGNUM)
values (4, 141, to_date('21-03-2013', 'dd-mm-yyyy'), to_date('21-03-2013', 'dd-mm-yyyy'), 276, to_date('21-03-2013', 'dd-mm-yyyy'), 19, null, 0, null, null, 0, 0, 156, null, 1, 0, 'medio', null, 0, 0, 0, 0, 0, 43);
insert into ORCAMENTO (EMPCOD, ORCCOD, ORCDATCAD, ORCDAT, ENTCOD, ORCDATVAL, ORCPRAENT, CONPAGCOD, ORCPERDES1, ORCPERDES2, ORCPERDES3, ORCVALFRE, ORCVALTOT, USUCOD, ORCOBS, ORCSTA, ORCVALADI, ORCPREVEN, ORCVEN, ORCINCFINADC, ORCINCFINFRE, ORCINCFINTXAB, ORCVALTXAB, ORCINDPERFIN, FORPAGNUM)
values (4, 121, to_date('18-03-2013', 'dd-mm-yyyy'), to_date('18-03-2013', 'dd-mm-yyyy'), 276, to_date('20-03-2013', 'dd-mm-yyyy'), 16, 1, 0, null, null, 0, 24150, 156, null, 1, 0, 'curto', null, 0, 0, 0, 0, 5, 43);
insert into ORCAMENTO (EMPCOD, ORCCOD, ORCDATCAD, ORCDAT, ENTCOD, ORCDATVAL, ORCPRAENT, CONPAGCOD, ORCPERDES1, ORCPERDES2, ORCPERDES3, ORCVALFRE, ORCVALTOT, USUCOD, ORCOBS, ORCSTA, ORCVALADI, ORCPREVEN, ORCVEN, ORCINCFINADC, ORCINCFINFRE, ORCINCFINTXAB, ORCVALTXAB, ORCINDPERFIN, FORPAGNUM)
values (4, 144, to_date('21-03-2013', 'dd-mm-yyyy'), to_date('21-03-2013', 'dd-mm-yyyy'), 276, to_date('21-03-2013', 'dd-mm-yyyy'), 19, null, 0, null, null, 0, 23000, 156, null, 1, 0, 'medio', null, 0, 0, 0, 0, 0, 43);
insert into ORCAMENTO (EMPCOD, ORCCOD, ORCDATCAD, ORCDAT, ENTCOD, ORCDATVAL, ORCPRAENT, CONPAGCOD, ORCPERDES1, ORCPERDES2, ORCPERDES3, ORCVALFRE, ORCVALTOT, USUCOD, ORCOBS, ORCSTA, ORCVALADI, ORCPREVEN, ORCVEN, ORCINCFINADC, ORCINCFINFRE, ORCINCFINTXAB, ORCVALTXAB, ORCINDPERFIN, FORPAGNUM)
values (4, 145, to_date('21-03-2013', 'dd-mm-yyyy'), to_date('21-03-2013', 'dd-mm-yyyy'), 276, to_date('21-03-2013', 'dd-mm-yyyy'), 19, 1, 5, null, null, 500, 23572.5, 156, null, 1, 100, 'medio', null, 1, 1, 0, 0, 5, 43);
insert into ORCAMENTO (EMPCOD, ORCCOD, ORCDATCAD, ORCDAT, ENTCOD, ORCDATVAL, ORCPRAENT, CONPAGCOD, ORCPERDES1, ORCPERDES2, ORCPERDES3, ORCVALFRE, ORCVALTOT, USUCOD, ORCOBS, ORCSTA, ORCVALADI, ORCPREVEN, ORCVEN, ORCINCFINADC, ORCINCFINFRE, ORCINCFINTXAB, ORCVALTXAB, ORCINDPERFIN, FORPAGNUM)
values (4, 146, to_date('21-03-2013', 'dd-mm-yyyy'), to_date('21-03-2013', 'dd-mm-yyyy'), 276, to_date('21-03-2013', 'dd-mm-yyyy'), 19, 1, 0, null, null, 0, 24150, 156, null, 1, 0, 'medio', null, 0, 0, 0, 0, 5, 43);
insert into ORCAMENTO (EMPCOD, ORCCOD, ORCDATCAD, ORCDAT, ENTCOD, ORCDATVAL, ORCPRAENT, CONPAGCOD, ORCPERDES1, ORCPERDES2, ORCPERDES3, ORCVALFRE, ORCVALTOT, USUCOD, ORCOBS, ORCSTA, ORCVALADI, ORCPREVEN, ORCVEN, ORCINCFINADC, ORCINCFINFRE, ORCINCFINTXAB, ORCVALTXAB, ORCINDPERFIN, FORPAGNUM)
values (4, 122, to_date('18-03-2013', 'dd-mm-yyyy'), to_date('18-03-2013', 'dd-mm-yyyy'), 277, to_date('20-03-2013', 'dd-mm-yyyy'), 16, 2, 0, null, null, 0, 24150, 156, null, 1, 0, 'curto', null, 0, 0, 0, 0, 5, 43);
commit;
prompt 6 records loaded
prompt Loading JUSTIFICATIVAS...
insert into JUSTIFICATIVAS (EMPCOD, ORCCOD, JUSDES)
values (4, 146, 'to tentando gravar issso aqui faz algum tempooooooooooooooooo....');
commit;
prompt 1 records loaded
prompt Loading ORCAMENTO_ITEM...
insert into ORCAMENTO_ITEM (ORCCOD, PROCOD, ORCITEPRODES, ORCITEPROQUA, ORCITEPROVALUNI, ORCITEDES, ORCITEVALTOT, USUCOD, EMPCOD)
values (121, 71, 'AG180', 1, 2000, null, 2000, 156, 4);
insert into ORCAMENTO_ITEM (ORCCOD, PROCOD, ORCITEPRODES, ORCITEPROQUA, ORCITEPROVALUNI, ORCITEDES, ORCITEVALTOT, USUCOD, EMPCOD)
values (121, 81, 'KIT 1', 1, 21000, null, 21000, 156, 4);
insert into ORCAMENTO_ITEM (ORCCOD, PROCOD, ORCITEPRODES, ORCITEPROQUA, ORCITEPROVALUNI, ORCITEDES, ORCITEVALTOT, USUCOD, EMPCOD)
values (144, 71, 'AG180', 1, 2000, null, 2000, 156, 4);
insert into ORCAMENTO_ITEM (ORCCOD, PROCOD, ORCITEPRODES, ORCITEPROQUA, ORCITEPROVALUNI, ORCITEDES, ORCITEVALTOT, USUCOD, EMPCOD)
values (144, 81, 'KIT 1', 1, 21000, null, 21000, 156, 4);
insert into ORCAMENTO_ITEM (ORCCOD, PROCOD, ORCITEPRODES, ORCITEPROQUA, ORCITEPROVALUNI, ORCITEDES, ORCITEVALTOT, USUCOD, EMPCOD)
values (145, 71, 'AG180', 1, 2000, null, 2000, 156, 4);
insert into ORCAMENTO_ITEM (ORCCOD, PROCOD, ORCITEPRODES, ORCITEPROQUA, ORCITEPROVALUNI, ORCITEDES, ORCITEVALTOT, USUCOD, EMPCOD)
values (145, 81, 'KIT 1', 1, 21000, null, 21000, 156, 4);
insert into ORCAMENTO_ITEM (ORCCOD, PROCOD, ORCITEPRODES, ORCITEPROQUA, ORCITEPROVALUNI, ORCITEDES, ORCITEVALTOT, USUCOD, EMPCOD)
values (146, 71, 'AG180', 1, 2000, null, 2000, 156, 4);
insert into ORCAMENTO_ITEM (ORCCOD, PROCOD, ORCITEPRODES, ORCITEPROQUA, ORCITEPROVALUNI, ORCITEDES, ORCITEVALTOT, USUCOD, EMPCOD)
values (146, 81, 'KIT 1', 1, 21000, null, 21000, 156, 4);
insert into ORCAMENTO_ITEM (ORCCOD, PROCOD, ORCITEPRODES, ORCITEPROQUA, ORCITEPROVALUNI, ORCITEDES, ORCITEVALTOT, USUCOD, EMPCOD)
values (122, 71, 'AG180', 1, 2000, null, 2000, 156, 4);
insert into ORCAMENTO_ITEM (ORCCOD, PROCOD, ORCITEPRODES, ORCITEPROQUA, ORCITEPROVALUNI, ORCITEDES, ORCITEVALTOT, USUCOD, EMPCOD)
values (122, 81, 'KIT 1', 1, 21000, null, 21000, 156, 4);
commit;
prompt 10 records loaded
prompt Loading PESQUISAS_PERGUNTAS...
insert into PESQUISAS_PERGUNTAS (PESPERCOD, PESPERDES, EMPCOD, USUCOD)
values (1, 'COMO O CLIENTE CONHECEU A RIOLAX?', 4, 156);
commit;
prompt 1 records loaded
prompt Loading PESQUISAS_PERGUNTAS_OPCOES...
insert into PESQUISAS_PERGUNTAS_OPCOES (PESPERCOD, PESPEROPCOD, PESPEROPDES, USUCOD)
values (1, 2, ' TV', 156);
insert into PESQUISAS_PERGUNTAS_OPCOES (PESPERCOD, PESPEROPCOD, PESPEROPDES, USUCOD)
values (1, 3, ' RADIO', 156);
insert into PESQUISAS_PERGUNTAS_OPCOES (PESPERCOD, PESPEROPCOD, PESPEROPDES, USUCOD)
values (1, 1, ' OUTDOOR', 156);
commit;
prompt 3 records loaded
prompt Loading PESQUISAS_RESPOSTAS...
insert into PESQUISAS_RESPOSTAS (PESPERCOD, ENTCOD, USUCOD, PESRESDES, PESRESOP)
values (1, 276, 156, 'TESTE', 0);
insert into PESQUISAS_RESPOSTAS (PESPERCOD, ENTCOD, USUCOD, PESRESDES, PESRESOP)
values (1, 277, 156, 'TERSS', 0);
commit;
prompt 2 records loaded
prompt Loading PRODUTO_IMAGEM...
prompt Table is empty
prompt Loading TABELA_PRECO_ITEM...
insert into TABELA_PRECO_ITEM (EMPCOD, TABPRECOD, PROCOD, TABPREITEVAL, USUCOD)
values (4, 21, 71, 175000, 156);
insert into TABELA_PRECO_ITEM (EMPCOD, TABPRECOD, PROCOD, TABPREITEVAL, USUCOD)
values (4, 1, 71, 2000, 156);
insert into TABELA_PRECO_ITEM (EMPCOD, TABPRECOD, PROCOD, TABPREITEVAL, USUCOD)
values (4, 1, 70, 10000, 156);
insert into TABELA_PRECO_ITEM (EMPCOD, TABPRECOD, PROCOD, TABPREITEVAL, USUCOD)
values (4, 1, 72, 12600, 156);
insert into TABELA_PRECO_ITEM (EMPCOD, TABPRECOD, PROCOD, TABPREITEVAL, USUCOD)
values (4, 1, 81, 14000, 156);
insert into TABELA_PRECO_ITEM (EMPCOD, TABPRECOD, PROCOD, TABPREITEVAL, USUCOD)
values (4, 1, 73, 11000, 156);
insert into TABELA_PRECO_ITEM (EMPCOD, TABPRECOD, PROCOD, TABPREITEVAL, USUCOD)
values (4, 1, 101, 2000, 156);
insert into TABELA_PRECO_ITEM (EMPCOD, TABPRECOD, PROCOD, TABPREITEVAL, USUCOD)
values (4, 10, 71, 3000, 156);
insert into TABELA_PRECO_ITEM (EMPCOD, TABPRECOD, PROCOD, TABPREITEVAL, USUCOD)
values (4, 10, 70, 15000, 156);
insert into TABELA_PRECO_ITEM (EMPCOD, TABPRECOD, PROCOD, TABPREITEVAL, USUCOD)
values (4, 10, 72, 17000, 156);
insert into TABELA_PRECO_ITEM (EMPCOD, TABPRECOD, PROCOD, TABPREITEVAL, USUCOD)
values (4, 10, 81, 21000, 156);
insert into TABELA_PRECO_ITEM (EMPCOD, TABPRECOD, PROCOD, TABPREITEVAL, USUCOD)
values (4, 10, 73, 16500, 156);
insert into TABELA_PRECO_ITEM (EMPCOD, TABPRECOD, PROCOD, TABPREITEVAL, USUCOD)
values (4, 10, 101, 3000, 156);
insert into TABELA_PRECO_ITEM (EMPCOD, TABPRECOD, PROCOD, TABPREITEVAL, USUCOD)
values (4, 41, 71, 3000, 156);
insert into TABELA_PRECO_ITEM (EMPCOD, TABPRECOD, PROCOD, TABPREITEVAL, USUCOD)
values (4, 41, 70, 15000, 156);
insert into TABELA_PRECO_ITEM (EMPCOD, TABPRECOD, PROCOD, TABPREITEVAL, USUCOD)
values (4, 41, 81, 21000, 156);
insert into TABELA_PRECO_ITEM (EMPCOD, TABPRECOD, PROCOD, TABPREITEVAL, USUCOD)
values (4, 41, 73, 16500, 156);
insert into TABELA_PRECO_ITEM (EMPCOD, TABPRECOD, PROCOD, TABPREITEVAL, USUCOD)
values (4, 41, 101, 3000, 156);
commit;
prompt 18 records loaded
prompt Loading UNIDADE_MEDIDA...
insert into UNIDADE_MEDIDA (UNIMEDCOD, UNIMEDDES)
values ('CX', 'CAIXA');
insert into UNIDADE_MEDIDA (UNIMEDCOD, UNIMEDDES)
values ('CM', 'CENTIMETRO');
commit;
prompt 2 records loaded
prompt Loading USUARIO_ACESSO...
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('137', 'FINANCEIRO -> CADASTROS -> FORMAS DE PAGAMENTO');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('257', 'CADASTROS -> FINANCEIRO -> FINANCEIRAS');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('158', 'CADASTROS -> PRODUTOS -> TABELA DE PRECOS');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('135', 'CADASTROS -> PRODUTOS -> PRODUTOS');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('217', 'PEDIDOS -> PESQUISAR');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('277', 'CADASTROS -> FINANCEIRO -> TIPO DE PAGAMENTOS');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('127', 'CADASTROS -> LOCALIDADE -> ESTADOS');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('128', 'CADASTROS -> LOCALIDADE -> CIDADES');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('129', 'CADASTROS -> PESSOAS -> PESSOA');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('130', 'CADASTROS -> PESSOAS -> TIPO');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('131', 'CADASTROS -> CONTROLE DE USUARIOS -> CADASTRO DE USUARIOS');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('133', 'CADASTROS -> CONTROLE DE USUARIO -> RESTRICOES');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('134', 'CADASTROS -> CONTROLE DE USUARIO -> CADASTRO DE GRUPOS DE USUARIOS');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('177', 'PEDIDOS -> ORCAMENTOS');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('125', 'CADASTROS -> UNIDADE DE MEDIDA');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('126', 'CADASTROS -> EMPRESAS');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('258', 'CADASTROS -> FINANCEIRO -> PARAMETROS DAS FINANCEIRA');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('297', 'FINANCEIRO -> CARTOES -> PARAMETROS DAS TRANSAESCO');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('337', 'PEDIDO -> PEDIDOS A ENVIAR');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('338', 'PEDIDO -> PEDIDOS ENVIADOS');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('197', 'CADASTROS -> PRODUTOS ->FICHA TECNICA');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('136', 'CADASTROS -> PRODUTOS -> GRUPO\SUB-GRUPO');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('132', 'CADASTROS -> CONTROLE DE USUARIO -> CADASTRO DE ACESSOS');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('237', 'RELATORIOS -> VENDEDORES -> CARTEIRA DE CLIENTES');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('278', 'CADASTROS -> FINANCEIROS -> FORMAS DE PAGAMENTO');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('238', 'CADASTROS -> MARKETING -> PERGUNTAS');
insert into USUARIO_ACESSO (USUACECOD, USEACEDESC)
values ('317', 'CADASTROS -> CONFIGURACOES -> FILIAL');
commit;
prompt 27 records loaded
prompt Loading USUARIO_EMPRESA...
insert into USUARIO_EMPRESA (USUCOD, EMPCOD)
values (29, 4);
insert into USUARIO_EMPRESA (USUCOD, EMPCOD)
values (156, 4);
insert into USUARIO_EMPRESA (USUCOD, EMPCOD)
values (156, 5);
insert into USUARIO_EMPRESA (USUCOD, EMPCOD)
values (159, 4);
insert into USUARIO_EMPRESA (USUCOD, EMPCOD)
values (159, 5);
insert into USUARIO_EMPRESA (USUCOD, EMPCOD)
values (178, 4);
insert into USUARIO_EMPRESA (USUCOD, EMPCOD)
values (178, 5);
insert into USUARIO_EMPRESA (USUCOD, EMPCOD)
values (197, 4);
insert into USUARIO_EMPRESA (USUCOD, EMPCOD)
values (197, 5);
commit;
prompt 9 records loaded
prompt Loading USUARIO_GRUPO_EMPRESA...
insert into USUARIO_GRUPO_EMPRESA (USUGRUCOD, EMPCOD)
values (26, 4);
commit;
prompt 1 records loaded
prompt Loading USUARIO_GRUPO_RESTRICAO...
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '217', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '277', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '257', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '257', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '277', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '158', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '158', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '217', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '177', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '258', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '258', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '297', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '177', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '297', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '337', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '337', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '338', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '338', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '125', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '126', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '127', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '128', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '129', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '130', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '131', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '132', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '133', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '134', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '135', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '136', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '137', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '197', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '197', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '125', 1, 1, 1, 1);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '126', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '127', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '128', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '129', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '130', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '131', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '132', 1, 1, 1, 1);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '133', 1, 1, 1, 1);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '134', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '135', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '136', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '237', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '237', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '238', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '238', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '278', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '278', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (26, '317', 2, 2, 2, 2);
insert into USUARIO_GRUPO_RESTRICAO (USUGRUCOD, USUACECOD, USUGRURESACE, USUGRURESINC, USUGRURESALT, USUGRURESEXC)
values (44, '317', 2, 2, 2, 2);
commit;
prompt 53 records loaded
prompt Loading USUARIO_RESTRICAO...
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '125', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '126', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '127', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '128', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '129', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '130', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '131', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '132', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '133', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '134', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '135', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '136', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '137', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '137', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '137', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '158', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '158', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '158', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '125', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '126', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '127', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '135', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '135', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '128', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '129', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '130', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '131', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '132', 1, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '133', 1, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '134', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '135', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '136', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '137', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '158', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '177', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '197', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '217', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '217', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '217', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '217', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '217', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '257', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '257', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '257', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '257', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '257', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '277', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '277', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '277', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '277', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '277', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '126', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '127', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '127', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '125', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '128', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '128', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '129', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '129', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '130', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '130', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '125', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '131', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '131', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '133', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '133', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '134', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '134', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '126', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '177', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '177', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '177', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '177', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '258', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '258', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '258', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '258', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '258', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '297', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '297', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '297', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '297', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '297', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '337', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '337', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '337', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '337', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '337', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '338', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '338', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '338', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '338', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '338', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '125', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '126', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '127', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '136', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '136', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '128', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '129', 1, 1, 1, 1);
commit;
prompt 100 records committed...
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '130', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '131', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '132', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '133', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '134', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '135', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '136', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '137', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '158', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '197', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '197', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '197', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '197', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '132', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '132', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '238', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '238', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '238', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '237', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '237', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '237', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '237', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '237', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '238', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '238', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '278', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '278', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '278', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '278', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '278', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (29, '317', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (156, '317', 1, 1, 1, 1);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (159, '317', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (178, '317', 2, 2, 2, 2);
insert into USUARIO_RESTRICAO (USUCOD, USUACECOD, USURESACE, USURESINC, USURESALT, USURESEXC)
values (197, '317', 2, 2, 2, 2);
commit;
prompt 135 records loaded
prompt Enabling foreign key constraints for USUARIO...
alter table USUARIO enable constraint FK_USUGRUCOD;
prompt Enabling foreign key constraints for USUARIO_GRUPO...
alter table USUARIO_GRUPO enable constraint FK_USU_GRU_USUARIO;
prompt Enabling foreign key constraints for CIDADE...
alter table CIDADE enable constraint FK_CIDADE_UF;
prompt Enabling foreign key constraints for EMPRESA...
alter table EMPRESA enable constraint FK_EMPRESA_CIDADE;
alter table EMPRESA enable constraint FK_EMPRESA_USUARIO;
prompt Enabling foreign key constraints for TIPO_PAGAMENTO...
alter table TIPO_PAGAMENTO enable constraint FK_TIPOPAGAMENTO_EMPRESA;
alter table TIPO_PAGAMENTO enable constraint FK_TIPOPAGAMENTO_USUARIO;
prompt Enabling foreign key constraints for FORMAS_PAGAMENTO...
alter table FORMAS_PAGAMENTO enable constraint FK_FORPAG_EMPRESA;
alter table FORMAS_PAGAMENTO enable constraint FK_FORPAG_TIPOPAG;
alter table FORMAS_PAGAMENTO enable constraint FK_FORPAG_USUARIO;
prompt Enabling foreign key constraints for CARTAO_CREDITO...
alter table CARTAO_CREDITO enable constraint FK_CARCRE_EMPRESA;
alter table CARTAO_CREDITO enable constraint FK_CARCRE_FORPAG;
alter table CARTAO_CREDITO enable constraint FK_CARCRE_USUARIO;
prompt Enabling foreign key constraints for CARTAO_CREDITO_PARAMETROS...
alter table CARTAO_CREDITO_PARAMETROS enable constraint PR_CARCREPAR_CARCRE;
prompt Enabling foreign key constraints for CATEG_ENTIDADE...
alter table CATEG_ENTIDADE enable constraint FK_CATEG_ENTIDADE_EMPRESA;
prompt Enabling foreign key constraints for FINANCEIRAS...
alter table FINANCEIRAS enable constraint FK_FINANC_EMPRESA;
alter table FINANCEIRAS enable constraint FK_FINANC_USUARIO;
prompt Enabling foreign key constraints for FINANCEIRAS_PARCELAS...
alter table FINANCEIRAS_PARCELAS enable constraint FK_FINPAR_EMPRES;
alter table FINANCEIRAS_PARCELAS enable constraint FK_FINPAR_FINANCEIRA;
alter table FINANCEIRAS_PARCELAS enable constraint FK_FINPAR_USUARIO;
prompt Enabling foreign key constraints for COND_PAG...
alter table COND_PAG enable constraint FK_COND_PAG_FIN_PAR;
alter table COND_PAG enable constraint FK_COND_PAG_FOR_PAG;
alter table COND_PAG enable constraint FK_COND_PAG_USUARIO;
prompt Enabling foreign key constraints for COND_PAG_PARC...
alter table COND_PAG_PARC enable constraint FK_COND_PAG_PARC_CP;
prompt Enabling foreign key constraints for TABELA_PRECO...
alter table TABELA_PRECO enable constraint FK_TAB_PRE_EMPRESA;
alter table TABELA_PRECO enable constraint FK_TAB_PRE_USUARIO;
prompt Enabling foreign key constraints for CONFIG_EMPRESA...
alter table CONFIG_EMPRESA enable constraint FK_CONEMP_TABPRE;
prompt Enabling foreign key constraints for EMPRESA_ATUACAO...
alter table EMPRESA_ATUACAO enable constraint FK_EMPATU_CIDADE;
alter table EMPRESA_ATUACAO enable constraint FK_EMPATU_EMPRESA;
alter table EMPRESA_ATUACAO enable constraint FK_EMPATU_USUARIO;
prompt Enabling foreign key constraints for ENTIDADE...
alter table ENTIDADE enable constraint FK_ENTIDADE_CATEG_ENTIDADE;
alter table ENTIDADE enable constraint FK_ENTIDADE_CIDADE;
alter table ENTIDADE enable constraint FK_ENTIDADE_CIDADE_COB;
alter table ENTIDADE enable constraint FK_ENTIDADE_EMPRES;
alter table ENTIDADE enable constraint FK_ENTIDADE_REPRES;
alter table ENTIDADE enable constraint FK_ENTIDADE_USUARIO;
prompt Enabling foreign key constraints for ENT_FONE...
alter table ENT_FONE enable constraint FK_ENT_FONE_ENTIDADE;
prompt Enabling foreign key constraints for PRODUTO_GRUPO...
alter table PRODUTO_GRUPO enable constraint FK_GRUPO_USUARIO;
prompt Enabling foreign key constraints for PRODUTO_SUBGRUPO...
alter table PRODUTO_SUBGRUPO enable constraint FK_SUBGRUPO_GRUPO;
alter table PRODUTO_SUBGRUPO enable constraint FK_SUBGRUPO_USUARIO;
prompt Enabling foreign key constraints for PRODUTO...
alter table PRODUTO enable constraint FK_PRODUTO_GRUPO;
alter table PRODUTO enable constraint FK_PRODUTO_SUBGRUPO;
alter table PRODUTO enable constraint FK_PRODUTO_USUARIO;
prompt Enabling foreign key constraints for FICHA_TECNICA...
alter table FICHA_TECNICA enable constraint FK_FICHA_TEC_EMPRESA;
alter table FICHA_TECNICA enable constraint FK_FICHA_TEC_PRODUTO;
alter table FICHA_TECNICA enable constraint FK_FICHA_TEC_USUARIO;
prompt Enabling foreign key constraints for FICHA_TECNICA_ITEM...
alter table FICHA_TECNICA_ITEM enable constraint FK_FIC_TEC_ITE_EMPRESA;
alter table FICHA_TECNICA_ITEM enable constraint FK_FIC_TEC_ITE_FIC_TEC;
alter table FICHA_TECNICA_ITEM enable constraint FK_FIC_TEC_ITE_PRODUTO;
alter table FICHA_TECNICA_ITEM enable constraint FK_FIC_TEC_ITE_USUARIO;
prompt Enabling foreign key constraints for ORCAMENTO...
alter table ORCAMENTO enable constraint FK_ORCAMENTO_COND_PAG;
alter table ORCAMENTO enable constraint FK_ORCAMENTO_EMPRESA;
alter table ORCAMENTO enable constraint FK_ORCAMENTO_ENTIDADE;
alter table ORCAMENTO enable constraint FK_ORCAMENTO_FORMASPAGAMENTO;
alter table ORCAMENTO enable constraint FK_ORCAMENTO_USUARIO;
prompt Enabling foreign key constraints for JUSTIFICATIVAS...
alter table JUSTIFICATIVAS enable constraint FK_JUST_ORCAMENTO;
prompt Enabling foreign key constraints for ORCAMENTO_ITEM...
alter table ORCAMENTO_ITEM enable constraint FK_ORCITE_ORC;
alter table ORCAMENTO_ITEM enable constraint FK_ORCITE_PRO;
alter table ORCAMENTO_ITEM enable constraint FK_ORCITE_USU;
prompt Enabling foreign key constraints for PESQUISAS_PERGUNTAS...
alter table PESQUISAS_PERGUNTAS enable constraint FK_PESPER_EMPRESA;
alter table PESQUISAS_PERGUNTAS enable constraint FK_PESPER_USUARIO;
prompt Enabling foreign key constraints for PESQUISAS_PERGUNTAS_OPCOES...
alter table PESQUISAS_PERGUNTAS_OPCOES enable constraint FK_PESPEROP_PESPER;
alter table PESQUISAS_PERGUNTAS_OPCOES enable constraint FK_PESPEROP_USUARIO;
prompt Enabling foreign key constraints for PESQUISAS_RESPOSTAS...
alter table PESQUISAS_RESPOSTAS enable constraint FK_PESRES_ENTIDADE;
alter table PESQUISAS_RESPOSTAS enable constraint FK_PESRES_PESPER;
prompt Enabling foreign key constraints for PRODUTO_IMAGEM...
alter table PRODUTO_IMAGEM enable constraint FK_PRO_IMA_PRODUTO;
alter table PRODUTO_IMAGEM enable constraint FK_PRO_IMA_USUARIO;
prompt Enabling foreign key constraints for TABELA_PRECO_ITEM...
alter table TABELA_PRECO_ITEM enable constraint FK_TAB_PRE_ITE_EMPRESA;
alter table TABELA_PRECO_ITEM enable constraint FK_TAB_PRE_ITE_TAB_PRE;
alter table TABELA_PRECO_ITEM enable constraint FK_TAB_PRE_ITE_USUARIO;
prompt Enabling foreign key constraints for USUARIO_EMPRESA...
alter table USUARIO_EMPRESA enable constraint FK_USU_EMP_EMPRESA;
alter table USUARIO_EMPRESA enable constraint FK_USU_EMP_USUARIO;
prompt Enabling foreign key constraints for USUARIO_GRUPO_EMPRESA...
alter table USUARIO_GRUPO_EMPRESA enable constraint FK_USU_GRU_EMP_EMP;
alter table USUARIO_GRUPO_EMPRESA enable constraint FK_USU_GRU_EMP_USU_GRU;
prompt Enabling foreign key constraints for USUARIO_RESTRICAO...
alter table USUARIO_RESTRICAO enable constraint FK_USU_REST_USU_ACE;
alter table USUARIO_RESTRICAO enable constraint FK_USU_REST_USUARIO;
prompt Enabling triggers for USUARIO...
alter table USUARIO enable all triggers;
prompt Enabling triggers for USUARIO_GRUPO...
alter table USUARIO_GRUPO enable all triggers;
prompt Enabling triggers for UF...
alter table UF enable all triggers;
prompt Enabling triggers for CIDADE...
alter table CIDADE enable all triggers;
prompt Enabling triggers for EMPRESA...
alter table EMPRESA enable all triggers;
prompt Enabling triggers for TIPO_PAGAMENTO...
alter table TIPO_PAGAMENTO enable all triggers;
prompt Enabling triggers for FORMAS_PAGAMENTO...
alter table FORMAS_PAGAMENTO enable all triggers;
prompt Enabling triggers for CARTAO_CREDITO...
alter table CARTAO_CREDITO enable all triggers;
prompt Enabling triggers for CARTAO_CREDITO_PARAMETROS...
alter table CARTAO_CREDITO_PARAMETROS enable all triggers;
prompt Enabling triggers for CATEG_ENTIDADE...
alter table CATEG_ENTIDADE enable all triggers;
prompt Enabling triggers for FINANCEIRAS...
alter table FINANCEIRAS enable all triggers;
prompt Enabling triggers for FINANCEIRAS_PARCELAS...
alter table FINANCEIRAS_PARCELAS enable all triggers;
prompt Enabling triggers for COND_PAG...
alter table COND_PAG enable all triggers;
prompt Enabling triggers for COND_PAG_PARC...
alter table COND_PAG_PARC enable all triggers;
prompt Enabling triggers for TABELA_PRECO...
alter table TABELA_PRECO enable all triggers;
prompt Enabling triggers for CONFIG_EMPRESA...
alter table CONFIG_EMPRESA enable all triggers;
prompt Enabling triggers for EMPRESA_ATUACAO...
alter table EMPRESA_ATUACAO enable all triggers;
prompt Enabling triggers for ENTIDADE...
alter table ENTIDADE enable all triggers;
prompt Enabling triggers for ENT_FONE...
alter table ENT_FONE enable all triggers;
prompt Enabling triggers for PRODUTO_GRUPO...
alter table PRODUTO_GRUPO enable all triggers;
prompt Enabling triggers for PRODUTO_SUBGRUPO...
alter table PRODUTO_SUBGRUPO enable all triggers;
prompt Enabling triggers for PRODUTO...
alter table PRODUTO enable all triggers;
prompt Enabling triggers for FICHA_TECNICA...
alter table FICHA_TECNICA enable all triggers;
prompt Enabling triggers for FICHA_TECNICA_ITEM...
alter table FICHA_TECNICA_ITEM enable all triggers;
prompt Enabling triggers for ORCAMENTO...
alter table ORCAMENTO enable all triggers;
prompt Enabling triggers for JUSTIFICATIVAS...
alter table JUSTIFICATIVAS enable all triggers;
prompt Enabling triggers for ORCAMENTO_ITEM...
alter table ORCAMENTO_ITEM enable all triggers;
prompt Enabling triggers for PESQUISAS_PERGUNTAS...
alter table PESQUISAS_PERGUNTAS enable all triggers;
prompt Enabling triggers for PESQUISAS_PERGUNTAS_OPCOES...
alter table PESQUISAS_PERGUNTAS_OPCOES enable all triggers;
prompt Enabling triggers for PESQUISAS_RESPOSTAS...
alter table PESQUISAS_RESPOSTAS enable all triggers;
prompt Enabling triggers for PRODUTO_IMAGEM...
alter table PRODUTO_IMAGEM enable all triggers;
prompt Enabling triggers for TABELA_PRECO_ITEM...
alter table TABELA_PRECO_ITEM enable all triggers;
prompt Enabling triggers for UNIDADE_MEDIDA...
alter table UNIDADE_MEDIDA enable all triggers;
prompt Enabling triggers for USUARIO_ACESSO...
alter table USUARIO_ACESSO enable all triggers;
prompt Enabling triggers for USUARIO_EMPRESA...
alter table USUARIO_EMPRESA enable all triggers;
prompt Enabling triggers for USUARIO_GRUPO_EMPRESA...
alter table USUARIO_GRUPO_EMPRESA enable all triggers;
prompt Enabling triggers for USUARIO_GRUPO_RESTRICAO...
alter table USUARIO_GRUPO_RESTRICAO enable all triggers;
prompt Enabling triggers for USUARIO_RESTRICAO...
alter table USUARIO_RESTRICAO enable all triggers;
set feedback on
set define on
prompt Done.
