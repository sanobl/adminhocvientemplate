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
                                  <TABLE cellSpacing=.;"0" cellPadding="0" width="94%" align="center" border="0">
                                    <TBODY>
                                      <TR>
                                        <TD style="FONT-SIZE: 100%; FONT-FAMILY: arial,sans-serif;">
                                          <P>Thân chào Bạn,</P>
                                          <P>
                                            Chúng tôi vừa nhận được yêu cầu của Bạn tại <a href = "@SiteURL@"><strong>@SiteURL@</strong></a> đối với tài khoản: <strong>@AccountName@</strong><br/>
											Mã yêu cầu: <strong>@RequestCode@</strong><br/>
											Kết quả hỗ trợ sẽ được cập nhật trong phần thông tin chi tiết của từng yêu cầu.<br/> 
											Bạn có thể vào <a href = "@SiteURL@danh-sach-yeu-cau.html"><strong>đây</strong></a> để xem các yêu cầu đã gửi.<br/>
                                          </P>
                                          <P>Nếu có nhu cầu trao đổi thêm thông tin. Bạn vui lòng liên lạc Tổng đài Dịch Vụ Khách Hàng số 1900.561.558 hoặc gửi yêu cầu tại <a href = "https://hotro.zing.vn"><strong>https://hotro.zing.vn</strong></a>. Chúng tôi luôn sẵn sàng phục vụ Bạn.</P>
                                          <P>Trân Trọng,</P>
                                          <P><strong>@Sender@</strong></P>
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
                                                    Huong dan xem noi dung bang Tieng Viet:<BR />
                                                    - Voi IE (Internet Explorer): Chon menu View -&gt; Encoding -&gt; chon Unicode (UTF-8) <BR />
                                                    - Voi Mozilla Firefox : Chon menu View -&gt; Character Encoding -&gt; chon Unicode (UTF-8) <BR />- Voi MS Outlook hoac Outlook Express: Chon menu View -&gt; Encoding -&gt; chon Unicode (UTF-8)
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
          <TD style="TEXT-ALIGN: center" vAlign="top" align="middle" background="https://@img_url@/theme/default/images/sendmail_bottom.jpg" height="28">VNG - Website Hỗ Trợ Khách Hàng Trực Tuyến: <a href = "https://hotro.zing.vn"><strong>www.hotro.zing.vn</strong></a></TD>
        </TR>
      </TBODY>
    </TABLE>

  </xsl:template>
</xsl:stylesheet>