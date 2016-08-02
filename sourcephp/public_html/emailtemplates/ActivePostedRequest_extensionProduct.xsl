<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:msxml="urn:schemas-microsoft-com:xslt"
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    version="1.0">

  <xsl:output method="xml" media-type="text/html" omit-xml-declaration="yes"/>

  <xsl:template match="/">
    <xsl:variable name="EmailFormat" select="EmailFormat" />

    <TABLE style="FONT-SIZE: 100%; FONT-FAMILY: arial,sans-serif;" cellSpacing="0" cellPadding="0" width="680" border="0">
      <TBODY>
        <TR>
          <TD background="https://@img_url@/theme/default/images/sendmail_top.jpg" height="28"></TD>
        </TR>
        <TR>
          <TD>
            <TABLE cellSpacing="0" cellPadding="0" width="100%" border="0">
              <TBODY>
                <TR>
                  <TD style="BACKGROUND-COLOR: #ef7510" width="5"></TD>
                  <TD>
                    <TABLE style="FONT-SIZE: 100%; FONT-FAMILY: arial,sans-serif;" cellSpacing="0" cellPadding="0" width="100%" border="0">
                      <TBODY>
                        <TR>
                          <TD background="https://@img_url@/theme/default/images/title_bg.gif">
                            <IMG id="top" height="40" src="https://@img_url@/theme/default/images/title_thongbao.jpg" width="200" />
                            <TABLE>
                              <TR>
                                <TD>
                                  <TABLE cellSpacing="0" cellPadding="0" width="94%" align="center" border="0">
                                    <TBODY>
                                      <TR>
                                        <TD style="FONT-SIZE: 100%; FONT-FAMILY: arial,sans-serif;">
                                          <P>Chào Bạn, </P>
                                          <P>
                                            Chúng tôi vừa nhận được yêu cầu của Bạn tại <a href="@SiteURL@"><strong>@SiteURL@</strong></a> đối với tài khoản: <strong>@AccountName@</strong><br />
											Để hoàn tất việc gửi yêu cầu, Bạn vui lòng nhấp chuột @URLActiveRequest@<br/>
											Nếu trong 24 giờ tới Bạn không kích hoạt gửi yêu cầu, yêu cầu của Bạn sẽ tự động bị hủy.<br/>
                                          </P>
										  <P>Nếu có nhu cầu trao đổi thêm thông tin. Bạn vui lòng liên lạc Tổng đài Dịch Vụ Khách Hàng số @Phone@ hoặc gửi yêu cầu tại <a href = "@SiteURL@"><strong>@SiteURL@</strong></a>. Chúng tôi luôn sẵn sàng phục vụ Bạn.</P>
                                          <P>Trân Trọng,</P>
                                          <P><strong>BP. Hỗ trợ khách hàng</strong></P>
                                        </TD>
                                      </TR>
                                    </TBODY>
                                  </TABLE>
                                </TD>
                              </TR>
                              <TR>
                                <TD height="40"></TD>
                              </TR>
                              <TR>
                                <TD>
                                  <TABLE cellSpacing="0" width="100%" border="0">
                                    <TBODY>
                                      <TR>
                                        <TD>
                                          <TABLE cellSpacing="0" cellPadding="0" width="94%" align="center" border="0">
                                            <TBODY>
                                              <TR>
                                                <TD style="FONT-SIZE: 100%; FONT-FAMILY: arial,sans-serif;">
                                                  <P>
                                                    <strong><i style="color:red;">Lưu ý:</i></strong> nếu không thể bấm vào các đường link được cung cấp trong email thì vui lòng <strong>bấm vào nút “Không phải thư rác” để chuyển email này từ Thư rác về Hộp thư đến</strong>,
                                                    sau đó bạn kiểm tra lại Hộp thư đến và có thể thao tác bấm vào đường link bình thường.
                                                  </P>
                                                </TD>
                                              </TR>
                                            </TBODY>
                                          </TABLE>
                                        </TD>
                                      </TR>

                                      <TR>
                                        <TD style="FONT-SIZE: 6px"></TD>
                                      </TR>
                                    </TBODY>
                                  </TABLE>
                                </TD>
                              </TR>
                            </TABLE>
                          </TD>
                        </TR>
                      </TBODY>
                    </TABLE>
                  </TD>
                  <TD style="BACKGROUND-COLOR: #ef7510" width="5"></TD>
                </TR>
              </TBODY>
            </TABLE>
          </TD>
        </TR>
        <TR>
          <TD style="TEXT-ALIGN: center" vAlign="top" align="middle" background="https://@img_url@/theme/default/images/sendmail_bottom.jpg" height="28"></TD>
        </TR>
      </TBODY>
    </TABLE>

  </xsl:template>
</xsl:stylesheet>